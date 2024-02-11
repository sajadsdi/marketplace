<?php

namespace Sajadsdi\Marketplace\Enums\Order;

enum OrderStatus: string
{
    case Pending    = 'pending';
    case Processing = 'processing';
    case Shipping   = 'shipping';
    case Completed  = 'completed';
    case Cancel     = 'cancel';
}
