<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Sau này bạn có thể lấy danh sách vợt từ Database tại đây
        return view('home');
    }
    
}
