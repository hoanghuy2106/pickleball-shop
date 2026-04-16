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

        // 1. Tìm kiếm theo từ khóa (Mới thêm)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('brand', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }

        // 2. Lọc theo danh mục
        if ($request->has('categories') && is_array($request->categories)) {
            $query->where(function($q) use ($request) {
                foreach ($request->categories as $category) {
                    $shortName = explode(' ', $category)[0]; 
                    $q->orWhere('name', 'LIKE', '%' . $shortName . '%'); 
                }
            });
        }

        // 3. Lọc theo thương hiệu
        if ($request->filled('brand')) {
            $query->where('brand', 'LIKE', $request->brand);
        }

        // 4. Lọc theo giá (Đã giữ nguyên logic của bạn)
        if ($request->filled('price_max')) {
            $price = $request->price_max;
            if ($price == '1000000') {
                $query->where('price', '<', 1000000);
            } elseif ($price == '3000000') {
                $query->whereBetween('price', [1000000, 3000000]);
            } elseif ($price == '5000000') {
                $query->whereBetween('price', [3000000, 5000000]);
            } elseif ($price == '10000000') {
                $query->where('price', '>', 5000000);
            } else {
                $query->where('price', '<=', $price);
            }
        }

        $products = $query->latest()->get();
        return view('products', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048', 
            'gallery.*' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products', 'public');
            }
            $data['gallery'] = $galleryPaths; 
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Thêm siêu phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

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

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
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
        
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

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