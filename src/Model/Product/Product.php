<?php

namespace Sajadsdi\Marketplace\Model\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sajadsdi\Marketplace\Model\Order\Order;
use Sajadsdi\Marketplace\Model\User\User;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'price', 'shipping_price', 'total_price'];

    /**
     * relation to user model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * relation to order model
     *
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity', 'price', 'shipping_price', 'total_price')
            ->withTimestamps();
    }

    /**
     * relation to product photo model
     *
     * @return HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->calculateTotalPrice();
        });

        static::updating(function ($product) {
            $product->calculateTotalPrice();
        });
    }

    private function calculateTotalPrice()
    {
        $this->total_price = $this->price + $this->shipping_price;
    }
}
