<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('categories') && is_array($request->categories)) {
            $query->where(function($q) use ($request) {
                foreach ($request->categories as $category) {
                    $shortName = explode(' ', $category)[0]; 
                    $q->orWhere('name', 'LIKE', '%' . $shortName . '%'); 
                }
            });
        }

        if ($request->filled('brand')) {
            $query->where('brand', 'LIKE', $request->brand);
        }

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

    // --- SỬA HÀM STORE ĐỂ LƯU NHIỀU ẢNH ---
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048', // Bỏ mimes, chỉ cần dùng 'image' là Laravel tự hiểu các định dạng phổ biến
            'gallery.*' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        // Xử lý ảnh chính
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Xử lý mảng ảnh phụ (Gallery)
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products', 'public');
            }
            $data['gallery'] = $galleryPaths; // Model tự động convert sang JSON nhờ $casts
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Thêm siêu phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // --- SỬA HÀM UPDATE ĐỂ CẬP NHẬT ẢNH PHỤ ---
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // Cập nhật ảnh chính
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Cập nhật ảnh phụ (Ghi đè hoặc thêm mới tùy bạn, ở đây là ghi đè danh sách cũ)
        if ($request->hasFile('gallery')) {
            // Xóa ảnh cũ trong kho (nếu cần tiết kiệm dung lượng)
            if ($product->gallery) {
                foreach ($product->gallery as $oldImg) {
                    Storage::disk('public')->delete($oldImg);
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products', 'public');
            }
            $data['gallery'] = $galleryPaths;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Xóa ảnh chính
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Xóa toàn bộ ảnh trong gallery
        if ($product->gallery) {
            foreach ($product->gallery as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $product->delete();
        return back()->with('success', 'Đã xóa siêu phẩm khỏi hệ thống!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); 
        return view('products.show', compact('product'));
    }
}