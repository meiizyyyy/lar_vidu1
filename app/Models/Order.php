<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'name',
        'phone',
        'email',
        'address',
        'notes',
    ];

    // Mỗi đơn hàng sẽ có nhiều sản phẩm (OrderItem)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Đơn hàng thuộc về người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
