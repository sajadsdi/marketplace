<?php

namespace Sajadsdi\Marketplace\Repository\Product;

use Sajadsdi\Marketplace\Repository\BaseCrudRepository;

class ProductPhotoRepository extends BaseCrudRepository implements ProductPhotoRepositoryInterface
{
    public function getModelName(): string
    {
        return config('marketplace.models.product_photo');
    }

    public function getSearchable(): array
    {
        return [];
    }

    public function getFilterable(): array
    {
        return [];
    }

    public function getSortable(): array
    {
        return [];
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }

}
