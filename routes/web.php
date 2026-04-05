<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
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

// QUAN TRỌNG: Phải để các route cố định (như /products/create) LÊN TRƯỚC các route có biến (như /{id})
// Nếu không Laravel sẽ tưởng chữ "create" là một cái ID và báo lỗi.

/*
|--------------------------------------------------------------------------
| 3. ROUTE YÊU CẦU ĐĂNG NHẬP (AUTH MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // 1. Chuyển Create lên đầu nhóm Auth
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    
    // 2. Các thao tác sửa/xóa
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // 3. Profile người dùng
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// ROUTE SHOW (Chi tiết sản phẩm) PHẢI ĐỂ SAU CÙNG
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


/*
|--------------------------------------------------------------------------
| 4. AUTHENTICATION (ĐĂNG NHẬP/ĐĂNG KÝ)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']); 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 5. GIỎ HÀNG (SESSION BASED)
|--------------------------------------------------------------------------
*/
Route::get('/cart', function () {
    $cart = session()->get('cart', []);
    return view('products.cart', compact('cart'));
})->name('cart.index');

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

Route::post('/cart/remove/{id}', function ($id) {
    $cart = session()->get('cart', []);
    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    return redirect()->back()->with('success', 'Đã xóa!');
})->name('cart.remove');

Route::patch('/cart/update', function (Request $request) {
    $cart = session()->get('cart', []);
    if($request->id && $request->quantity) {
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
        return response()->json(['message' => 'Updated']);
    }
})->name('cart.update');
// Route cho trang Khám phá
Route::get('/explore', [PageController::class, 'explore'])->name('explore');

// Route cho trang Hỗ trợ
Route::get('/support', [PageController::class, 'support'])->name('support');