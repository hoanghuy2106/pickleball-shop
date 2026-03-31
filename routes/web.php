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
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

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

// 4. GIỎ HÀNG (Đã bổ sung đầy đủ Xóa và Cập nhật)

// Hiển thị giỏ hàng
Route::get('/cart', function () {
    $cart = session()->get('cart', []);
    return view('products.cart', compact('cart'));
})->name('cart.index');

// Thêm sản phẩm (Dùng cho AJAX từ trang danh sách)
Route::post('/add-to-cart', function (Request $request) {
    $cart = session()->get('cart', []);
    $productName = $request->name;
    
    if(isset($cart[$productName])) {
        $cart[$productName]['quantity']++;
    } else {
        $cart[$productName] = [
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'image' => $request->image,
            'quantity' => 1
        ];
    }
    session()->put('cart', $cart);
    return response()->json(['count' => count($cart)]);
})->name('cart.add');

// XÓA SẢN PHẨM (Nút thùng rác cần cái này)
Route::post('/cart/remove/{id}', function ($id) {
    $cart = session()->get('cart', []);
    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    return redirect()->back()->with('success', 'Đã xóa!');
})->name('cart.remove');

// CẬP NHẬT SỐ LƯỢNG (Nếu Huy làm nút + - bằng AJAX)
Route::patch('/cart/update', function (Request $request) {
    $cart = session()->get('cart', []);
    if($request->id && $request->quantity) {
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
        return response()->json(['message' => 'Updated']);
    }
})->name('cart.update');
Route::middleware('auth')->group(function () {
    // ... các route khác của ông ...
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});
// Thêm ->name('profile.update') vào cuối Route POST
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
