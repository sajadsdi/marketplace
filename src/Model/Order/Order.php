<?php

namespace Sajadsdi\Marketplace\Model\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sajadsdi\Marketplace\Enums\Order\OrderStatus;
use Sajadsdi\Marketplace\Model\Product\Product;
use Sajadsdi\Marketplace\Model\User\User;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'total_price', 'status'];

    protected $casts = [
        'status' => OrderStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('quantity', 'price', 'shipping_price','total_price')
            ->withTimestamps();
    }
}
