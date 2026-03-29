<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Trang hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('products.cart', compact('cart'));
    }

    // Hàm thêm vào giỏ hàng (AJAX gọi đến đây)
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
                "image" => $request->image, // Lưu URL ảnh tuyệt đối
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'count' => count($cart),
            'message' => 'Đã thêm vào giỏ hàng!'
        ]);
    }
}