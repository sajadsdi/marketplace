<?php

namespace Sajadsdi\Marketplace\Repository\Product;

interface ProductRepositoryInterface
{
    public function findById(int $id);

    public function getProductsByIds(array $ids);

}
