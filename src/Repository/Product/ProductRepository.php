<?php

namespace Sajadsdi\Marketplace\Repository\Product;

use Sajadsdi\Marketplace\Repository\BaseCrudRepository;

class ProductRepository extends BaseCrudRepository implements ProductRepositoryInterface
{
    public function getModelName(): string
    {
        return config('marketplace.models.product');
    }

    public function getSearchable(): array
    {
        return ['title'];
    }

    public function getFilterable(): array
    {
        return ['id', 'user_id', 'title', 'price', 'shipping_price', 'total_price'];
    }

    public function getSortable(): array
    {
        return ['id', 'user_id', 'title', 'price', 'shipping_price', 'total_price'];
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }

    public function index(string $search = null, string $filter = null, string $sort = null, int $perPage = 15): array
    {
        return $this->with('photos')->search($search)->filter($filter)->sort($sort)->paginate($perPage)->toArray();
    }

    public function read(int|string $id): array
    {
        return $this->with('photos')->find($id)?->toArray() ?? [];
    }

    public function getProductsByIds(array $ids)
    {
        return $this->whereIn('id', $ids)->get();
    }
}
