<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 1. Trang chủ và Liên hệ
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', function () { return view('contact'); });

// 2. Quản lý Sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::middleware('auth')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// 3. Cụm chức năng Đăng nhập & Đăng ký
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']); 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 4. Giỏ hàng (Đã sửa logic để fix lỗi ảnh khi F5)
Route::get('/cart', function () {
    $cart = session()->get('cart', []);
    return view('products.cart', compact('cart'));
})->name('cart.index');

Route::post('/add-to-cart', function (Request $request) {
    $cart = session()->get('cart', []);
    
    // Sử dụng ID hoặc Name làm Key để tránh trùng lặp và giữ link ảnh chuẩn
    $productName = $request->name;
    
    if(isset($cart[$productName])) {
        $cart[$productName]['quantity']++;
    } else {
        $cart[$productName] = [
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'image' => $request->image, // Nhận URL tuyệt đối từ JS
            'quantity' => 1
        ];
    }
    
    session()->put('cart', $cart);
    
    // Trả về tổng số lượng sản phẩm khác nhau trong giỏ
    return response()->json(['count' => count($cart)]);
})->name('cart.add');