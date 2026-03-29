<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // THÊM DÒNG NÀY ĐỂ CHO PHÉP LƯU DỮ LIỆU
    protected $fillable = ['name', 'brand', 'price', 'image','color','description'];
}