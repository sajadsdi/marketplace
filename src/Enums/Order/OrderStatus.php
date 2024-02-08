<?php

namespace Sajadsdi\Marketplace\Enums\Order;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Shipping = 'shipping';
    case Completed = 'completed';
}
