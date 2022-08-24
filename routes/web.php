<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestCheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('welcome');
Route::get('/guest-cart', [GuestCheckoutController::class,'guest_cart'])->name('guest_cart');
Route::post('/', [GuestCheckoutController::class,'add_to_guest_cart'])->name('add_to_guest_cart');
Route::post('/guest-cart', [GuestCheckoutController::class,'guest_remove'])->name('guest_remove');
Route::post('/guest-checkout', [GuestCheckoutController::class,'guest_checkout'])->name('guest_checkout');
Route::get('/guest-checkout', [GuestCheckoutController::class,'guest_checkout']);
Route::post('/guest-order', [GuestCheckoutController::class,'guest_order'])->name('guest_order');
Route::post('/reorder',[HomeController::class,'reorder_welcome'])->name('reorder_welcome');
Route::post('/guest-cart/edit-qty',[GuestCheckoutController::class,'guest_edit_qty'])->name('guest_edit_qty');
Route::post('/details', [HomeController::class,'guest_show_details'])->name('guest_show_details');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard/like', [DashboardController::class,'index']);
    Route::get('/dashboard/reorder', [DashboardController::class,'index']);
    Route::get('/dashboard/cart', [DashboardController::class,'cart']);
    Route::get('/dashboard/return',[DashboardController::class,'index'])->name('return');
    Route::post('/dashboard/like',[DashboardController::class,'like'])->name('like_dashboard');
    Route::post('/dashboard/reorder',[DashboardController::class,'reorder'])->name('reorder');
    Route::post('/dashboard/cart', [CheckoutController::class,'add_to_cart'])->name('add_to_cart');
    Route::get('/dashboard/details', [DashboardController::class,'show_details']);
    Route::post('/dashboard/details', [DashboardController::class,'show_details'])->name('show_details');
    Route::post('/wishlist',[DashboardController::class,'like'])->name('like_wishlist');
    Route::get('/wishlist', [HomeController::class,'show_wishlist'])->name('wishlist');
    Route::get('/upload', [DashboardController::class,'upload'])->name('upload');
    Route::post('store-image',[UploadController::class,'up']);
    Route::get('/profile',[ProfileController::class,'show'])->name('profile');
    Route::get('/profile/edit',[ProfileController::class,'edit']);
    Route::post('/profile/edit',[ProfileController::class,'edit'])->name('edit');
    Route::post('/profile/show-orders',[ProfileController::class,'show_orders'])->name('show_orders');
    Route::post('/profile/update-image',[ProfileController::class,'update_image'])->name('update_image');
    Route::post('/profile/delete-post',[ProfileController::class,'delete'])->name('delete');
    Route::get('/cart', [CheckoutController::class,'cart'])->name('cart');
    Route::post('/cart', [CheckoutController::class,'add_to_cart'])->name('add_to_cart');
    Route::post('/cart', [CheckoutController::class,'remove'])->name('remove');
    Route::post('/cart/edit-qty',[CheckoutController::class,'edit_qty'])->name('edit_qty');
    Route::post('/checkout', [CheckoutController::class,'checkout'])->name('checkout');
    Route::get('/checkout', [CheckoutController::class,'checkout']);
    Route::post('/order', [CheckoutController::class,'order'])->name('order');
    Route::post('/follow', [ProfileController::class,'follow'])->name('follow');
    Route::post('/unfollow', [ProfileController::class,'unfollow'])->name('unfollow');
    Route::post('/search', [ProfileController::class,'search'])->name('search');
});


require __DIR__.'/auth.php';
