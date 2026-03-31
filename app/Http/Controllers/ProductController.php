<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // CẬP NHẬT HÀM INDEX ĐỂ LỌC DỮ LIỆU
public function index(Request $request)
{
    $query = Product::query();

// Sửa đoạn lọc danh mục thành thế này:
if ($request->has('categories') && is_array($request->categories)) {
    $query->where(function($q) use ($request) {
        foreach ($request->categories as $category) {
            $shortName = explode(' ', $category)[0]; 
            // Chỉ tìm trong cột 'name' thôi, bỏ 'category' đi
            $q->orWhere('name', 'LIKE', '%' . $shortName . '%'); 
        }
    });
}

    // LỌC THƯƠNG HIỆU (Chuẩn hóa để tránh lỗi hoa/thường)
    if ($request->filled('brand')) {
        $query->where('brand', 'LIKE', $request->brand);
    }

    // LỌC GIÁ
    if ($request->filled('price_max')) {
        $query->where('price', '<=', $request->price_max);
    }

    $products = $query->latest()->get();
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
            'category' => 'nullable|string', // Huy nhớ thêm cột category vào validate nhé
            'price' => 'required|numeric',
            'color' => 'nullable|string',
            'description' => 'nullable|string',
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
            'category' => 'nullable|string',
            'price' => 'required|numeric',
            'color' => 'nullable|string',
            'description' => 'nullable|string',
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

    public function show($id)
    {
        $product = Product::findOrFail($id); 
        return view('products.show', compact('product'));
    }
}