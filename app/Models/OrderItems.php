<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'orders_id',
        'product_id',
        'quantity',
        'price',
        'image'
    ];

    // Quan hệ nhiều một với Order
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    // Quan hệ nhiều một với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
