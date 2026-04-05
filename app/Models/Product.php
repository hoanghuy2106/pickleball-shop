<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 1. THÊM 'gallery' VÀO ĐÂY
    protected $fillable = [
        'name', 
        'brand', 
        'price', 
        'image', 
        'gallery', // Cột lưu nhiều ảnh phụ
        'color', 
        'description'
    ];

    // 2. THÊM DÒNG NÀY (CỰC KỲ QUAN TRỌNG)
    // Nó giúp tự động biến mảng ảnh thành JSON khi lưu và ngược lại
    protected $casts = [
        'gallery' => 'array',
    ];
}