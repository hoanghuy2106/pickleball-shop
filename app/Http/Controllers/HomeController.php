<?php

namespace App\Http\Controllers;
use App\Models\Product; // Nhớ import Model Product
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::latest()->take(3)->get();
        // Sau này bạn có thể lấy danh sách vợt từ Database tại đây
        return view('home', compact('featuredProducts'));;
    }
    
}
