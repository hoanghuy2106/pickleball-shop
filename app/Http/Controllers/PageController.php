<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Player; // 1. Đừng quên dòng này để Laravel hiểu Player là ai

class PageController extends Controller
{
    // Trang Khám Phá (Gộp logic lấy BXH vào đây)
    public function explore() 
    {
        // 2. Lấy Top 3 người chơi điểm cao nhất từ Database
        // Nếu database chưa có dữ liệu, nó sẽ trả về danh sách trống mà không bị lỗi
        $topPlayers = Player::orderBy('elo_points', 'desc')->take(10)->get();

        // 3. Trả về view 'pages.explore' cùng với biến $topPlayers
        return view('pages.explore', compact('topPlayers'));
    }

    // Trang Hỗ Trợ
    public function support() 
    {
        return view('pages.support');
    }
    public function index()
{
    // Lấy 3 hoặc 6 sản phẩm mới nhất hoặc có đánh dấu 'featured'
    $featuredProducts = Product::latest()->take(3)->get(); 

    return view('welcome', compact('featuredProducts'));
}
}