<?php

namespace Sajadsdi\Marketplace\Model\User;

use App\Models\User as BaseUserModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sajadsdi\Marketplace\Model\Order\Order;
use Sajadsdi\Marketplace\Model\Product\Product;

class User extends BaseUserModel
{
    use SoftDeletes;

    /**
     * relation to order model
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * relation to product model
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
