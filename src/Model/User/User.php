<?php

namespace Sajadsdi\Marketplace\Model\User;

use App\Models\User as BaseUserModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sajadsdi\Marketplace\Model\Order\Order;
use Sajadsdi\Marketplace\Model\Product\Product;

class User extends BaseUserModel
{
    use SoftDeletes;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
