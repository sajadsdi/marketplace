<?php

return [
    'auth'     => [
        'request_uri'  => 'auth',
        'request_type' => 'get',
        'middleware'   => [],
        'controller'   => \Sajadsdi\Marketplace\Http\Controllers\API\V1\Auth\AuthController::class,
        'method'       => 'user',
        'routes'       => [
            'login'    => [
                'request_uri'        => 'login',
                'request_type'       => 'post',
                'middleware'         => 'guest.api:sanctum',
                'without_middleware' => 'auth.api:sanctum',
                'method'             => 'login',
            ],
            'register' => [
                'request_uri'        => 'register',
                'request_type'       => 'post',
                'middleware'         => 'guest.api:sanctum',
                'without_middleware' => 'auth.api:sanctum',
                'method'             => 'register',
            ],
            'logout'   => [
                'request_uri'  => 'logout',
                'request_type' => 'post',
                'method'       => 'logout',
            ]
        ]
    ],
    'products' => [
        'request_uri'  => 'products',
        'request_type' => 'get',
        'middleware'   => [],
        'controller'   => '\Sajadsdi\Marketplace\Http\Controllers\API\V1\Products\ProductController',
        'method'       => 'index',
        'routes'       => [
            'photos' => [
                'request_uri'  => '{productId}/photos',
                'request_type' => 'get',
                'controller'   => '\Sajadsdi\Marketplace\Http\Controllers\API\V1\Products\ProductPhotoController',
                'method'       => 'index',
                'routes'       => [
                    'create' => [
                        'request_uri'  => '',
                        'request_type' => 'post',
                        'method'       => 'store',
                    ],
                    'delete' => [
                        'request_uri'  => '{id}',
                        'request_type' => 'delete',
                        'method'       => 'destroy',
                    ],
                ]
            ],
            'create' => [
                'request_uri'  => '',
                'request_type' => 'post',
                'method'       => 'store',
            ],
            'single' => [
                'request_uri'  => '{id}',
                'request_type' => 'get',
                'method'       => 'single',
            ],
            'update' => [
                'request_uri'  => '{id}',
                'request_type' => 'put',
                'method'       => 'update',
            ],
            'delete' => [
                'request_uri'  => '{id}',
                'request_type' => 'delete',
                'method'       => 'destroy',
            ]
        ]
    ],
    'orders'   => [
        'request_uri'  => 'orders',
        'request_type' => 'get',
        'middleware'   => [],
        'controller'   => '\Sajadsdi\Marketplace\Http\Controllers\API\V1\Orders\OrderController',
        'method'       => 'index',
        'routes'       => [
            'create' => [
                'request_uri'  => '',
                'request_type' => 'post',
                'method'       => 'store',
            ],
            'single' => [
                'request_uri'  => '{id}',
                'request_type' => 'get',
                'method'       => 'single',
            ],
        ]
    ]
];
