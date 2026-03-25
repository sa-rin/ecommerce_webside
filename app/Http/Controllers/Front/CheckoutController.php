<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use KHQR\Config\Constants;

class CheckoutController extends Controller
{
    /**
     * Generate QR code for an order
     */
    public function generateQR($id) 
    {
        // Use Order instead of Product
        $order = Order::findOrFail($id);

        $merchant = new IndividualInfo(
            'sarin_ouk@bkrt',   // bakongAccountID
            'Sarin Ouk',        // merchantName
            'Phnom Penh',        // merchantCity
            KHQRData::CURRENCY_USD,
            $order->total        // total amount from order
        );

        $qrResponse = BakongKHQR::generateIndividual($merchant);

        return view("front.checkout.qrcode", [
            'order' => $order,
            'qr' => $qrResponse->data['qr'] ?? null,
            'md5' => $qrResponse->data['md5'] ?? null,
        ]);
    }

    /**
     * Verify QR transaction
     */
        public function verifyTransaction(Request $request)
    {
        $request->validate([
            'md5' => 'required|string',
            'order_id' => 'required|exists:orders,id',
        ]);

        try {
            $order = Order::findOrFail($request->order_id);

            // Increase timeout and add retries to handle intermittent network/DNS issues
            $response = Http::withToken(env('BAKONG_TOKEN'))
                ->timeout(30)
                ->connectTimeout(10)
                ->retry(3, 100)
                ->when(app()->environment('local'), function ($http) {
                    return $http->withoutVerifying(); // ✅ Fix SSL error on localhost
                })
                ->post(Constants::CHECK_TRANSACTION_MD5_URL, [
                    'md5' => $request->md5
                ]);

            if ($response->failed()) {
                Log::error("Bakong API Error: " . $response->body());
                return response()->json(['success' => false, 'error' => 'Verification failed'], 500);
            }

            $result = $response->json();
            Log::info("Bakong API Response for Order {$order->id}: " . json_encode($result));

            // Check if payment is completed
            // Use round() to avoid floating point precision issues when comparing amounts
            $receivedAmount = (float)($result['data']['amount'] ?? $result['amount'] ?? 0);
            $orderTotal = (float)$order->total;

            if (($result['responseCode'] ?? null) === 0) {
                // Check if amount matches
                if (round($receivedAmount, 2) === round($orderTotal, 2)) {
                    if ($order->payment_status !== 'paid') {
                        $order->update([
                            'payment_status' => 'paid',
                            'status' => 'confirmed'
                        ]);
                    }
                    return response()->json(['success' => true]); // ✅ Perfect match
                } else {
                    Log::warning("Bakong Amount Mismatch for Order {$order->id}: Expected {$orderTotal}, Received {$receivedAmount}");
                    
                    // For local development, we might want to be lenient or at least notify
                    // return response()->json(['success' => true, 'warning' => 'Amount mismatch']); 
                    
                    return response()->json([
                        'success' => false, 
                        'error' => 'Amount mismatch', 
                        'expected' => $orderTotal, 
                        'received' => $receivedAmount
                    ]);
                }
            }

            return response()->json(['success' => false, 'debug' => $result]); // Not paid yet

        } catch (\Exception $e) {
            Log::error("Bakong Verification Exception: " . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show checkout page
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('front.checkout.index', compact('cart'));
    }

    /**
     * Store checkout order
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('cart_toast', 'Cart is empty!');
        }

        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'address_line'   => 'required|string|max:255',
            'city'           => 'nullable|string|max:255',
            'note'           => 'nullable|string|max:255',
            'payment_method' => 'required|in:cod,qr',
            'payment_ref'    => 'nullable|string|max:255',
            'receipt_image'  => 'nullable|image|max:4096', // 4MB
        ]);

        // calculate subtotal from session cart
        $subtotal = 0;
        foreach ($cart as $it) {
            $subtotal += ((float)$it['price']) * ((int)$it['qty']);
        }
        $shipping = 0;
        $total = $subtotal + $shipping;

        // store with transaction
        $order = DB::transaction(function () use ($request, $cart, $subtotal, $shipping, $total) {

            // upload receipt if provided
            $receiptPath = null;
            if ($request->hasFile('receipt_image')) {
                $receiptPath = $request->file('receipt_image')->store('receipts', 'public');
            }

            $paymentStatus = $request->payment_method === 'qr'
                ? 'pending'   // wait admin confirm
                : 'unpaid';   // COD unpaid until delivered

            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'customer_phone'=> $request->customer_phone,
                'address_line'  => $request->address_line,
                'city'          => $request->city,
                'note'          => $request->note,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total'    => $total,
                'status'         => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'payment_ref'    => $request->payment_ref,
                'receipt_image'  => $receiptPath,
            ]);

            // create items
            foreach ($cart as $pid => $it) {
                $qty = (int)$it['qty'];

                // optional: verify product still exists
                $p = Product::find($pid);
                $name = $it['name'] ?? ($p?->ProductName ?? 'Unknown');
                $price = (float)$it['price'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $pid,
                    'product_name' => $name,
                    'price' => $price,
                    'qty' => $qty,
                    'line_total' => $price * $qty,
                ]);

                // optional: reduce stock if you have stock column
                // if ($p && isset($p->stock)) { $p->decrement('stock', $qty); }
            }

            return $order;
        });

        // clear cart after create order
        session()->forget('cart');

        // ✅ If QR → go to QR page
        if ($order->payment_method === 'qr') {
            return redirect()->route('generate.qr', $order->id);
        }

        // ✅ Otherwise (COD)
        return redirect()->route('checkout.success', $order->id)
            ->with('cart_toast', '✅ Order placed successfully!');
    }

    /**
     * Show success page
     */
    public function success(Order $order)
    {
        $order->load('items');
        return view('front.checkout.success', compact('order'));
    }
}