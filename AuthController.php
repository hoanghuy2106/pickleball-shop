<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

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
            'role'     => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard'); 
            }
            return redirect()->intended('/'); 
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function profile() {
        $user = Auth::user(); 
        
        // Lấy danh sách đơn hàng (Admin lấy hết, User lấy của mình)
        if ($user->role === 'admin') {
            $orders = Order::orderBy('created_at', 'desc')->get();
        } else {
            $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('auth.profile', compact('user', 'orders'));
    }

    public function updateProfile(Request $request) 
    {
        $user = User::findOrFail(Auth::id()); 

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|numeric|digits_between:10,11', 
            'address' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Hệ thống đã cập nhật định danh mới!');
    }

    /**
     * Cập nhật trạng thái đơn hàng (Dành cho Admin)
     */
    public function updateOrderStatus(Request $request, $id)
    {
        // 1. Kiểm tra quyền Admin
        if (Auth::user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền thực hiện thao tác này!'], 403);
        }

        // 2. Tìm đơn hàng
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy đơn hàng #'.$id], 404);
        }
        
        // 3. Logic chuyển đổi trạng thái (Khớp với View hiển thị)
        $currentStatus = $order->status;
        $nextStatus = '';

        switch ($currentStatus) {
            case 'pending':   
                $nextStatus = 'confirmed'; // Xác nhận đơn
                $msg = 'Đã xác nhận đơn hàng thành công!';
                break;   
            case 'confirmed': 
                $nextStatus = 'shipping';  // Giao cho đơn vị vận chuyển
                $msg = 'Đơn hàng đã được bàn giao vận chuyển!';
                break; 
            case 'shipping':  
                $nextStatus = 'completed'; // Khách đã nhận hàng
                $msg = 'Đơn hàng đã hoàn thành!';
                break; 
            default: 
                $nextStatus = $currentStatus;
                $msg = 'Trạng thái không thể thay đổi thêm.';
        }

        // 4. Cập nhật vào Database
        $order->status = $nextStatus;
        $order->save();

        return response()->json([
            'success' => true, 
            'new_status' => $nextStatus,
            'message' => $msg
        ]);
    }
}