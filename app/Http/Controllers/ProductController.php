<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\User; // Thêm dòng này
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    /**
     * Cấu hình Middleware theo chuẩn Laravel 11.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    /**
     * Kiểm tra quyền Admin (Ép kiểu để xóa gạch đỏ VS Code).
     */
    private function isAdmin(): bool
    {
        // Ép kiểu trực tiếp về Model User để VS Code nhận diện được thuộc tính role
        $user = Auth::user();
        
        if ($user instanceof User) {
            return $user->role === 'admin';
        }

        return false;
    }

    /**
     * Danh sách sản phẩm kèm bộ lọc.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('brand', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }

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
        if (!$this->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Chỉ Admin mới có quyền truy cập!');
        }
        return view('products.create');
    }

    public function store(Request $request)
    {
        if (!$this->isAdmin()) {
            abort(403);
        }

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

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); 
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Bạn không có quyền sửa!');
        }
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        if (!$this->isAdmin()) {
            abort(403);
        }

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
            if ($product->image) Storage::disk('public')->delete($product->image);
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
        if (!$this->isAdmin()) {
            return back()->with('error', 'Bạn không có quyền xóa!');
        }

        $product = Product::findOrFail($id);
        if ($product->image) Storage::disk('public')->delete($product->image);
        if ($product->gallery) {
            foreach ($product->gallery as $img) Storage::disk('public')->delete($img);
        }

        $product->delete();
        return back()->with('success', 'Đã xóa sản phẩm!');
    }
}