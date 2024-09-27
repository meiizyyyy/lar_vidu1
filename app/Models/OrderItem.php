<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Sản phẩm trong đơn hàng thuộc về một đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Mỗi sản phẩm trong đơn hàng thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
