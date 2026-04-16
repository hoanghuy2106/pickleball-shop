<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'receiver_name', // Khớp với database trong ảnh
        'phone', 
        'address', 
        'total_price', 
        'payment_method', 
        'status'
    ];
    public function orderItems() {
    return $this->hasMany(OrderItem::class);
}
}