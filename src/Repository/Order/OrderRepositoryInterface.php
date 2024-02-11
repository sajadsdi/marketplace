<?php

namespace Sajadsdi\Marketplace\Repository\Order;

interface OrderRepositoryInterface
{
    public function findById(int $id);

    public function getForEmailById(int $id);

    public function getUserOrders(int $userId, string $search = null, string $filter = null, string $sort = null, int $perPage = 15): array;

}
