<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('products.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $name = $request->name;

        if(isset($cart[$name])) {
            $cart[$name]['quantity']++;
        } else {
            $cart[$name] = [
                "name" => $request->name,
                "brand" => $request->brand,
                "price" => $request->price,
                "image" => $request->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'count' => count($cart),
            'message' => 'Đã thêm vào giỏ hàng!'
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                return response()->json(['status' => 'success', 'message' => 'Cập nhật thành công!']);
            }
        }
        return response()->json(['status' => 'error'], 400);
    }

 public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $request->validate([
            'receiver_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|in:transfer,cod'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        // 1. Tính tổng tiền
        $totalAmount = 0;
        foreach($cart as $item) {
            $price = (int) str_replace([',', '.', 'đ'], '', $item['price']);
            $totalAmount += $price * $item['quantity'];
        }

        // 2. Lưu vào bảng Orders (Sử dụng Model \App\Models\Order)
        $order = \App\Models\Order::create([
            'user_id' => Auth::id(),
            'receiver_name' => $request->receiver_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $totalAmount,
            'payment_method' => $request->payment_method,
            'status' => 'pending'
        ]);

        // 3. Lưu chi tiết từng món vào bảng OrderItems
        foreach($cart as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => (int) str_replace([',', '.', 'đ'], '', $item['price']),
                'quantity' => $item['quantity'],
                'image' => $item['image']
            ]);
        }

        // 4. Xóa giỏ hàng và thông báo
        session()->forget('cart');

        $message = $request->payment_method == 'transfer' 
            ? 'Cảm ơn ông! Quét mã thành công, đơn hàng đang chờ xác nhận.' 
            : 'Đặt hàng thành công! Trả tiền khi nhận hàng (COD) nhé.';

        return redirect()->route('products.index')->with('success', $message);
    }
}