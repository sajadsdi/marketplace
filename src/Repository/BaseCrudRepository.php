<?php

namespace Sajadsdi\MarketplaceTest\Repository;

use Sajadsdi\LaravelRepository\Concerns\Crud\Crud;
use Sajadsdi\LaravelRepository\Repository;
use Sajadsdi\LaravelRestResponse\Contracts\CrudRepositoryInterface;

abstract class BaseCrudRepository extends Repository implements CrudRepositoryInterface
{
    use Crud;
}
