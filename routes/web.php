<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. TRANG CHỦ & NỘI DUNG TĨNH
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () { return view('about'); })->name('introduction');
Route::get('/contact', function () { return view('contact'); })->name('contact');

/*
|--------------------------------------------------------------------------
| 2. QUẢN LÝ SẢN PHẨM (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

/*
|--------------------------------------------------------------------------
| 3. ROUTE YÊU CẦU ĐĂNG NHẬP (AUTH MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/admin/dashboard', [AuthController::class, 'profile'])->name('admin.dashboard');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::post('/order/update-status/{id}', [AuthController::class, 'updateOrderStatus'])->name('admin.order.update');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

/*
|--------------------------------------------------------------------------
| 4. AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']); 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 5. GIỎ HÀNG
|--------------------------------------------------------------------------
*/
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::patch('/update', [CartController::class, 'update'])->name('update');
});
Route::post('/add-to-cart', [CartController::class, 'add']);

/*
|--------------------------------------------------------------------------
| 6. CÁC TRANG KHÁC
|--------------------------------------------------------------------------
*/
Route::get('/explore', [PageController::class, 'explore'])->name('explore');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/order/details/{id}', [OrderController::class, 'getDetails']);
Route::post('/order/update-status/{id}', [OrderController::class, 'updateStatus']);
// Đường dẫn lấy dữ liệu doanh thu
Route::get('/admin/revenue-stats', [App\Http\Controllers\AuthController::class, 'getRevenueStats'])->middleware('auth');
Route::middleware('auth')->group(function () {
    // Lấy doanh thu (Nên thêm middleware admin ở đây nếu cần chặt chẽ hơn)
    Route::get('/admin/revenue-stats', [AuthController::class, 'getRevenueStats']);
    
    // Cập nhật & Hủy đơn
    Route::post('/admin/orders/{id}/update', [AuthController::class, 'updateOrderStatus']);
    Route::post('/orders/{id}/cancel', [AuthController::class, 'cancelOrder']);
});
// Thêm dòng này vào file routes/web.php
Route::post('/order/cancel/{id}', [App\Http\Controllers\OrderController::class, 'cancel'])->name('order.cancel');