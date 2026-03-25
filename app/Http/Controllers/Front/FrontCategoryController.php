<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class FrontCategoryController extends Controller
{
    //
    
public function categoryProducts(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $q = Product::where('CategoryID', $id);

    // Filter price
    if ($request->filled('min_price')) $q->where('Price', '>=', $request->min_price);
    if ($request->filled('max_price')) $q->where('Price', '<=', $request->max_price);

    // Sort
    switch ($request->sort) {
        case 'latest':     $q->orderBy('id','desc'); break;
        case 'price_asc':  $q->orderBy('Price','asc'); break;
        case 'price_desc': $q->orderBy('Price','desc'); break;
        case 'name_asc':   $q->orderBy('ProductName','asc'); break;
        case 'name_desc':  $q->orderBy('ProductName','desc'); break;
        default:           $q->orderBy('id','desc');
    }

    $products = $q->paginate(12);

    return view('front.categories.products', compact('category','products'));
}
}
