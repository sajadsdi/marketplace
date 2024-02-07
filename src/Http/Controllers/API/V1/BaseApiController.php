<?php

namespace Sajadsdi\MarketplaceTest\Http\Controllers\API\V1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Sajadsdi\LaravelRestResponse\Concerns\CrudApi;
use Sajadsdi\LaravelRestResponse\Http\Controllers\RestController;

class BaseApiController extends RestController
{
    use CrudApi, AuthorizesRequests, ValidatesRequests;
}
