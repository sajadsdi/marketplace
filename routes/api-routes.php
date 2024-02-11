<?php

use Illuminate\Support\Facades\Route;
use Sajadsdi\LaravelDynamicRouter\DynamicRouter;

Route::middleware(['auth.api:sanctum'])->group(function () {
    Route::group(['prefix' => 'v1'], function () {
        DynamicRouter::Process(config('routes-api'), 'api-v1');
    });
});
