<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Nên có dòng này
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory; // Và dòng này

   protected $fillable = [
    'order_id', 
    'product_id', // BẮT BUỘC phải có để liên kết sang bảng sản phẩm
    'product_name', 
    'price', 
    'quantity', 
    'image'
];

public function product() {
    // Khai báo rõ khóa ngoại nếu bạn đặt tên khác product_id
    return $this->belongsTo(Product::class, 'product_id'); 
}
}