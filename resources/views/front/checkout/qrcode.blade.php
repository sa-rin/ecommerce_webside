@extends('layouts.app')

@push('styles')
    <style>
        .payment-card {
            max-width: 550px;
            margin: 2rem auto;
            padding: 2.5rem;
        }

        .qr-wrapper {
            background: white;
            padding: 1.5rem;
            border-radius: 24px;
            display: inline-block;
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .qr-wrapper:hover {
            transform: scale(1.02);
        }

        .gradient-text {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .order-info {
            background: rgba(99, 102, 241, 0.05);
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .item-list {
            background: transparent;
            border: none;
            max-width: 450px;
            margin: 0 auto 2rem;
        }

        .item-list .list-group-item {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 12px !important;
            margin-bottom: 8px;
            padding: 0.8rem 1.2rem;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
            }

            70% {
                transform: scale(1.02);
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }

        .countdown-timer {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="soft-card payment-card text-center">
            <h1 class="gradient-text mb-2">Scan KHQR to Pay</h1>

            <div class="order-info mb-4">
                <h5 class="mb-1 fw-bold">Order #{{ $order->id }}</h5>
                <div class="fs-4 text-primary fw-bold">${{ number_format($order->total, 2) }}</div>
            </div>

            <div class="item-list list-group mb-4">
                @foreach ($order->items as $item)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-semibold text-secondary">{{ $item->product_name }}</span>
                        <span class="badge bg-light text-primary pill">Qty: {{ $item->qty }}</span>
                    </div>
                @endforeach
            </div>

            @if ($qr)
                <div class="qr-wrapper">
                    {!! QrCode::size(220)->generate($qr) !!}
                </div>

                <div class="mt-2 mb-4">
                    <div id="payment-status-container" class="alert alert-info border-0 shadow-sm status-badge">
                        <div class="spinner-grow spinner-grow-sm" role="status"></div>
                        <span id="payment-message" class="mb-0 fw-bold">Waiting for payment...</span>
                    </div>
                </div>

                <!-- <div class="d-grid gap-2 max-width-300 mx-auto" style="max-width: 300px;">
                        <button onclick="checkPayment()" class="btn btn-outline-dark pill px-4">
                            <i class="bi bi-arrow-clockwise me-2"></i>Check Payment Now
                        </button>
                    </div> -->

                <div class="mt-4 pt-3 border-top border-light">
                    <p class="text-muted small mb-1">Bakong Merchant ID Hash</p>
                    <code class="d-block mb-3 text-secondary" style="font-size: 0.75rem;">{{ $md5 }}</code>
                    <p class="text-muted mb-0">Scan this QR code using <strong>Bakong App</strong> to pay.</p>
                </div>
            @else
                <div class="alert alert-danger rounded-4 py-4">
                    <i class="bi bi-exclamation-triangle-fill fs-1 mb-2 d-inline-block"></i>
                    <h5 class="fw-bold">Failed to generate KHQR</h5>
                    <p class="mb-0">Please try refreshing the page or contact support.</p>
                </div>
            @endif

            {{-- Countdown Timer --}}
            <div class="mt-5 mb-2">
                <div id="countdown" class="countdown-timer">120</div>
                <p class="text-muted small text-uppercase fw-bold letter-spacing-1">
                    Expires in <span id="seconds">120</span> seconds
                </p>
            </div>

            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-link text-decoration-none text-secondary">
                    <i class="bi bi-chevron-left me-1"></i>Back to Shop
                </a>
            </div>
        </div>
    </div>

    <script>
        let seconds = 120;
        const countdownEl = document.getElementById('countdown');
        const secondsEl = document.getElementById('seconds');

        // Countdown Timer
        const timer = setInterval(() => {
            seconds--;
            if (countdownEl) countdownEl.textContent = seconds;
            if (secondsEl) secondsEl.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(timer);
                Swal.fire({
                    icon: 'warning',
                    title: 'Session Expired',
                    text: 'This payment session has expired. Please try again.',
                    confirmButtonText: 'Back to Cart',
                    confirmButtonColor: '#6366f1',
                    customClass: {
                        popup: 'rounded-4 border-0 shadow-lg'
                    }
                }).then(() => {
                    window.location.href = "{{ route('cart.index') }}";
                });
            }
        }, 1000);

        // Polling for payment verification
        const md5 = "{{ $md5 }}";
        const orderId = "{{ $order->id }}";

        const checkPayment = () => {
            const messageEl = document.getElementById('payment-message');
            const statusContainer = document.getElementById('payment-status-container');

            fetch(`/checkout/verify?md5=${md5}&order_id=${orderId}`)
                .then(res => {
                    if (!res.ok) throw new Error('Connection failed');
                    return res.json();
                })
                .then(data => {
                    console.log('Payment check response:', data);
                    if (data.success) {
                        clearInterval(paymentCheck);
                        clearInterval(timer);

                        if (messageEl && statusContainer) {
                            messageEl.textContent = "✅ Payment confirmed!";
                            statusContainer.classList.replace('alert-info', 'alert-success');
                            statusContainer.style.animation = 'none';
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Payment Successful!',
                            text: 'Your order has been confirmed thank you!',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'rounded-4 border-0 shadow-lg'
                            },
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        }).then(() => {
                            window.location.href = "{{ route('home') }}";
                        });
                    } else if (data.error === 'Amount mismatch') {
                        if (messageEl && statusContainer) {
                            messageEl.innerHTML = `⚠️ Amount Mismatch! Expected: $${data.expected.toFixed(2)}, Paid: $${data.received.toFixed(2)}`;
                            statusContainer.classList.replace('alert-info', 'alert-warning');
                        }
                    }
                })
                .catch(err => {
                    console.error('Verification error:', err);
                    if (messageEl) {
                        messageEl.textContent = "Checking payment status...";
                    }
                });
        };

        // Initial check immediately
        checkPayment();

        // Polling every 2 seconds for "immediate" feel
        const paymentCheck = setInterval(checkPayment, 2000);
    </script>
@endsection