<?php

namespace Sajadsdi\Marketplace\Repository\Order;

use Illuminate\Database\Eloquent\Model;
use Sajadsdi\Marketplace\Enums\Order\OrderStatus;
use Sajadsdi\Marketplace\Jobs\SendOrderSubmittedEmail;
use Sajadsdi\Marketplace\Repository\BaseCrudRepository;

class OrderRepository extends BaseCrudRepository implements OrderRepositoryInterface
{
    public function getModelName(): string
    {
        return config('marketplace.models.order');
    }

    public function getSearchable(): array
    {
        return [];
    }

    public function getFilterable(): array
    {
        return ['id', 'total_price', 'status', 'shipping'];
    }

    public function getSortable(): array
    {
        return ['id', 'total_price', 'status', 'shipping'];
    }

    public function findById(int $id)
    {
        return $this->with('products')->find($id);
    }

    public function getForEmailById(int $id)
    {
        return $this->with(['user', 'products'])->find($id);
    }

    public function getUserOrders(int $userId, string $search = null, string $filter = null, string $sort = null, int $perPage = 15): array
    {
        return $this->where('user_id', $userId)->search($search)->filter($filter)->sort($sort)->paginate($perPage)->toArray();
    }

    public function create(array $data): array
    {
        $totalPrice = $this->calculateTotalPrice($data['products'], $data['shipping']);

        $order = $this->query()->create([
            'user_id'     => $data['user_id'],
            'shipping'    => $data['shipping'],
            'total_price' => $totalPrice,
            'status'      => OrderStatus::Processing
        ]);

        $this->updateOrderProducts($order, $data['products']);

        SendOrderSubmittedEmail::dispatch($order->id);

        return $order->toArray();
    }

    private function calculateTotalPrice(array $products, bool $shipping): float
    {
        $total = 0.00;

        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];

            if ($shipping) {
                $total += $product['shipping_price'];
            }
        }

        return $total;
    }

    private function updateOrderProducts(Model $order, array $products)
    {
        $pivotData = [];

        foreach ($products as $product) {
            $pivotData[$product['id']] = [
                'quantity'       => $product['quantity'],
                'price'          => $product['price'],
                'shipping_price' => $order->shipping ? $product['shipping_price'] : 0
            ];
        }

        $order->products()->sync($pivotData);
    }
}
