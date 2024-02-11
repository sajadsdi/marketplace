<?php

namespace Sajadsdi\Marketplace\Model\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sajadsdi\Marketplace\Enums\Order\OrderStatus;
use Sajadsdi\Marketplace\Jobs\SendOrderSubmittedEmail;
use Sajadsdi\Marketplace\Model\Product\Product;
use Sajadsdi\Marketplace\Model\User\User;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'total_price', 'status', 'shipping'];

    protected $casts = [
        'status'   => OrderStatus::class,
    ];

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
     * relation to product model
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('quantity', 'price', 'shipping_price')
            ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {
            SendOrderSubmittedEmail::dispatch($order->id);
        });
    }
}
