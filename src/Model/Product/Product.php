<?php

namespace Sajadsdi\Marketplace\Model\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sajadsdi\Marketplace\Model\Order\Order;
use Sajadsdi\Marketplace\Model\Products\ProductPhoto;
use Sajadsdi\Marketplace\Model\User\User;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'price', 'shipping_price','total_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity', 'price', 'shipping_price','total_price')
            ->withTimestamps();
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
}
