<?php

return [
    //for sending new order email
    'admin_email' => "admin@test.com",
    //for resize uploaded images for product
    'product_photo_width' => 500,
    //destination disk for uploads
    'upload_disk' => 'public',

    //for more customize
    'models' => [
        'user'          => \Sajadsdi\Marketplace\Model\User\User::class,
        'product'       => \Sajadsdi\Marketplace\Model\Product\Product::class,
        'product_photo' => \Sajadsdi\Marketplace\Model\Product\ProductPhoto::class,
        'order'         => \Sajadsdi\Marketplace\Model\Order\Order::class,
    ],
    'policies' => [
        'delete-product' => [
            \Sajadsdi\Marketplace\Policies\GeneralPolicy::class,
            'delete',
        ],
        'delete-product-photo' => [
            \Sajadsdi\Marketplace\Policies\GeneralPolicy::class,
            'delete',
        ],
        'update-product' => [
            \Sajadsdi\Marketplace\Policies\GeneralPolicy::class,
            'update',
        ],
        'view-order' => [
            \Sajadsdi\Marketplace\Policies\GeneralPolicy::class,
            'view',
        ],
    ],
];
