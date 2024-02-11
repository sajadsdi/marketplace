<?php

namespace Sajadsdi\Marketplace\Http\Controllers\API\V1\Orders;

use Sajadsdi\Marketplace\Http\Controllers\API\V1\BaseApiController;
use Sajadsdi\Marketplace\Http\Requests\API\V1\Orders\OrderCreateRequest;
use Sajadsdi\Marketplace\Repository\Order\OrderRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Sajadsdi\Marketplace\Repository\Product\ProductRepositoryInterface;

class OrderController extends BaseApiController
{
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    /**
     * Display a listing of the resources.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        return $this->response($this->repository->getUserOrders($request->user()->id, $request?->search, $request?->filter, $request?->sort, 20));
    }

    /**
     * Store a new resource.
     */
    public function store(OrderCreateRequest $request, ProductRepositoryInterface $productRepository): Response|ResponseFactory
    {
        $data['shipping'] = $request->shipping;
        $data['user_id']  = $request->user()->id;

        $productIds = array_unique(array_column($request->products, 'id'));
        $quantities = array_column($request->products, 'quantity', 'id');

        $products = $productRepository->getProductsByIds($productIds);

        $products->map(function ($product) use ($quantities) {
            $product['quantity'] = $quantities[$product->id];
        });

        $data['products'] = $products->toArray();

        return $this->createOperation($data);
    }

    /**
     * Display the specified resource.
     */
    public function single($id, Request $request): Response|ResponseFactory
    {
        $order = $this->repository->findById($id);

        if (!$order) {
            return $this->notFoundResponse();
        }

        if ($request->user()->can('view-order', $order)) {
            return $this->response($order);
        }

        return $this->forbiddenResponse('Access deny!');
    }
}
