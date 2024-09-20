<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  // ID của người dùng
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id'); // Hoặc 'cart_id' nếu cần
    }


    public function user()
    {
        return $this->belongsTo(User::class); // Quan hệ với User
    }
}
