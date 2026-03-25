<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});
use App\Http\Controllers\AuthController;

Route::get('/register',[AuthController::class,'showRegister']);
Route::post('/register',[AuthController::class,'register']);
Route::get('/login',[AuthController::class,'showLogin']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/admin',[AuthController::class,'dashboard'])->middleware('auth');
Route::get('/logout',[AuthController::class,'logout']);

use App\Http\Controllers\CategoryController;
Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
Route::post('/categoryStore', [CategoryController::class, 'store'])->name('category.store');
Route::any('/categoryList', [CategoryController::class, 'list'])->name('category.list');
Route::get('/categoryEdit/{id}', [CategoryController::class,'categoryShowData']);
Route::post('/categoryEdit', [CategoryController::class, 'categoryUpdate']);
Route::get('/categoryDelete/{id}', [CategoryController::class, 'categoryDelete']);

//Product
use App\Http\Controllers\ProductController;
Route::get('/product', [ProductController::class, 'product']);
Route::post('/productStore', [ProductController::class, 'productStore']);
Route::get('/productList', [ProductController::class, 'productList']);
Route::get('/productEdit/{id}', [ProductController::class,'productShowData']);
Route::post('/productEdit', [ProductController::class,'productUpdate']);
Route::get('/productDelete/{id}', [ProductController::class, 'productDelete']);



// Banner
use App\Http\Controllers\BannerController;
Route::get('/banner', [BannerController::class, 'create'])->name('banner.create');
Route::post('/bannerStore', [BannerController::class, 'store'])->name('banner.store');
Route::get('/bannerList', [BannerController::class, 'list'])->name('banner.list');
Route::get('/bannerEdit/{id}', [BannerController::class, 'showEdit'])->name('banner.edit');
Route::post('/bannerEdit', [BannerController::class, 'update'])->name('banner.update');
Route::get('/bannerDelete/{id}', [BannerController::class, 'delete'])->name('banner.delete');




// Footer CRUD
use App\Http\Controllers\FooterController;
Route::get('/footer', [FooterController::class, 'create'])->name('footer.create');
Route::post('/footerStore', [FooterController::class, 'store'])->name('footer.store');
Route::get('/footerList', [FooterController::class, 'list'])->name('footer.list');
Route::get('/footerEdit/{id}', [FooterController::class, 'showEdit'])->name('footer.edit');
Route::post('/footerEdit', [FooterController::class, 'update'])->name('footer.update');
Route::get('/footerDelete/{id}', [FooterController::class, 'delete'])->name('footer.delete');

// Slider
use App\Http\Controllers\SliderController;
Route::get('/slider', [SliderController::class, 'create'])->name('slider.create');
Route::post('/sliderStore', [SliderController::class, 'store'])->name('slider.store');
Route::get('/sliderList', [SliderController::class, 'list'])->name('slider.list');
Route::get('/sliderEdit/{id}', [SliderController::class, 'showEdit'])->name('slider.edit');
Route::post('/sliderEdit', [SliderController::class, 'update'])->name('slider.update');
Route::get('/sliderDelete/{id}', [SliderController::class, 'delete'])->name('slider.delete');


use App\Http\Controllers\Front\CategoryFrontController;
use App\Http\Controllers\Front\CategoryProductFrontController;  
use App\Http\Controllers\Front\FrontCategoryController;

Route::get('/categories', [CategoryFrontController::class, 'index'])
    ->name('front.categories.index');
// Route::get('/category/{category}/products', [CategoryProductFrontController::class, 'index'])
// ->name('front.category.products');
Route::get('/category/{id}/products', [FrontCategoryController::class,'categoryProducts']);

use App\Http\Controllers\Front\HomeController;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('front.about');
Use App\Http\Controllers\Front\ProductFrontController;

Route::get('/product/{product}', [ProductFrontController::class,'show'])->name('products.show');

use App\Http\Controllers\Front\CartFrontController;
Route::get('/cart', [CartFrontController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartFrontController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartFrontController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartFrontController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartFrontController::class, 'clear'])->name('cart.clear');

use App\Http\Controllers\Front\CheckoutController;

Route::get('/checkout', [CheckoutController::class,'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class,'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class,'success'])->name('checkout.success');

Route::get('/checkout/verify', [CheckoutController::class, 'verifyTransaction']);
Route::get('/checkout/qr/{id}', [CheckoutController::class, 'generateQR'])->name('generate.qr');