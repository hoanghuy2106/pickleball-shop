<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get(); 
        return view('products', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'color' => 'nullable|string',         // THÊM DÒNG NÀY
            'description' => 'nullable|string',   // THÊM DÒNG NÀY
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'color' => 'nullable|string',         // THÊM DÒNG NÀY
            'description' => 'nullable|string',   // THÊM DÒNG NÀY
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return back()->with('success', 'Đã xóa sản phẩm!');
    }
}