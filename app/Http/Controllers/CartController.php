<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // 1. Trang hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        // Đảm bảo file view của ông nằm đúng đường dẫn resources/views/products/cart.blade.php
        return view('products.cart', compact('cart'));
    }

    // 2. Thêm vào giỏ hàng (Dùng cho nút 30%, 70%)
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

    // 3. XÓA SẢN PHẨM (Huy thiếu cái này nên lỗi nè)
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    // 4. CẬP NHẬT SỐ LƯỢNG (Dành cho nút + -)
    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Cập nhật thành công!']);
        }
    }
}