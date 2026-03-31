<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- MỚI THÊM: Hàm hiển thị trang Đăng nhập ---
    public function showLogin()
    {
        return view('auth.login');
    }

    // --- MỚI THÊM: Hàm hiển thị trang Đăng ký ---
    public function showRegister()
    {
        return view('auth.register');
    }

    // 1. Xử lý Đăng ký (Khi bấm nút gửi Form)
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ], [
            'email.unique' => 'Email này đã được sử dụng!',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự.'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
    }

    // 2. Xử lý Đăng nhập (Khi bấm nút gửi Form)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); 
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // 3. Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
public function profile() {
    $user = Auth::user(); 
    return view('auth.profile', compact('user'));
}
public function updateProfile(Request $request) 
{
    // 1. Lấy ID của user đang đăng nhập
    $userId = Auth::id(); 
    
    // 2. Tìm chính xác Model User từ Database để kích hoạt đầy đủ tính năng của Eloquent
    $user = User::findOrFail($userId); 

    // 3. Kiểm tra dữ liệu đầu vào
    $request->validate([
        'name'    => 'required|string|max:255',
        'phone'   => 'nullable|numeric|digits_between:10,11', 
        'address' => 'nullable|string|max:500',
    ], [
        'phone.numeric' => 'Số điện thoại phải là chữ số!',
        'phone.digits_between' => 'Số điện thoại phải từ 10 đến 11 số!',
    ]);

    // 4. Đổ dữ liệu vào Model và Lưu
    $user->name = $request->name;
    $user->phone = $request->phone;
    $user->address = $request->address;
    
    $user->save();

    // 5. Quay lại trang cũ với thông báo cam xịn xò
    return back()->with('success', 'Hệ thống đã cập nhật định danh mới!');
}
}
