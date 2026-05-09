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
/**
 * Lấy dữ liệu báo cáo doanh thu (Chỉ Admin mới xem được)
 */
public function getRevenueStats(Request $request)
{
    if (Auth::user()->role !== 'admin') {
        return response()->json(['success' => false, 'message' => 'Quyền hạn từ chối'], 403);
    }

    $period = $request->query('period', 'month');
    $query = Order::query();

    if ($period == 'day') { $query->whereDate('created_at', today()); } 
    elseif ($period == 'month') { $query->whereMonth('created_at', now()->month); }
    elseif ($period == 'year') { $query->whereYear('created_at', now()->year); }

    // LOGIC: Doanh thu = Đơn 'completed' (bao gồm cả COD và Transfer đã xong)
    $totalRevenue = $query->clone()->where('status', 'completed')->sum('total_price');
    $orderCount = $query->clone()->where('status', 'completed')->count();
    $averageOrder = $orderCount > 0 ? $totalRevenue / $orderCount : 0;

    return response()->json([
        'success' => true,
        'data' => [
            'total' => $totalRevenue,
            'count' => $orderCount,
            'avg' => $averageOrder
        ]
    ]);
}

/**
 * Hủy đơn hàng (Cả Admin và Khách đều dùng được)
 */
public function cancelOrder($id)
{
    $order = Order::findOrFail($id);
    $user = Auth::user();

    // Khách chỉ được hủy đơn của mình và khi đơn đang ở trạng thái 'pending'
    if ($user->role !== 'admin') {
        if ($order->user_id !== $user->id) return response()->json(['success' => false, 'message' => 'Không có quyền!'], 403);
        if ($order->status !== 'pending') return response()->json(['success' => false, 'message' => 'Chỉ có thể hủy khi đơn đang chờ xác nhận!'], 400);
    }

    $order->status = 'cancelled';
    $order->save();

    return response()->json(['success' => true, 'message' => 'Đã hủy đơn hàng thành công!']);
}

/**
 * Cập nhật trạng thái (Admin dùng để chốt đơn hoàn thành)
 */
public function updateOrderStatus(Request $request, $id)
{
    if (Auth::user()->role !== 'admin') return response()->json(['success' => false], 403);

    $order = Order::findOrFail($id);
    $statusMap = [
        'pending' => 'confirmed',
        'confirmed' => 'shipping',
        'shipping' => 'completed'
    ];

    if (isset($statusMap[$order->status])) {
        $order->status = $statusMap[$order->status];
        $order->save();
        return response()->json(['success' => true, 'new_status' => $order->status]);
    }

    return response()->json(['success' => false, 'message' => 'Không thể chuyển trạng thái']);
}
}