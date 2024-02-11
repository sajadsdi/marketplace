<?php

namespace Sajadsdi\Marketplace\Repository\User;

use Sajadsdi\Marketplace\Repository\BaseCrudRepository;

class UserRepository extends BaseCrudRepository implements UserRepositoryInterface
{
    public function getModelName(): string
    {
        return config('marketplace.models.user');
    }

    public function getSearchable(): array
    {
        return ['user_id', 'total_price', 'status', 'shipping'];
    }

    public function getFilterable(): array
    {
        return ['user_id', 'total_price', 'status', 'shipping'];
    }

    public function getSortable(): array
    {
        return ['user_id', 'total_price', 'status', 'shipping'];
    }

    public function register(array $data)
    {
        return $this->query()->create($data);
    }
}
