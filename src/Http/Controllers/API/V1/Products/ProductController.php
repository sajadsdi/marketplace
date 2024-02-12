<?php

namespace Sajadsdi\Marketplace\Http\Controllers\API\V1\Products;

use Sajadsdi\Marketplace\Http\Controllers\API\V1\BaseApiController;
use Sajadsdi\Marketplace\Http\Requests\API\V1\Products\ProductCreateRequest;
use Sajadsdi\Marketplace\Repository\Product\ProductRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }

    /**
     * Display a listing of the resources.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        return $this->indexOperation($request?->search, $request?->filter, $request?->sort, 20);
    }

    /**
     * Store a new resource.
     */
    public function store(ProductCreateRequest $request): Response|ResponseFactory
    {
        $storeData            = $request->validated();
        $storeData['user_id'] = $request->user()->id;

        return $this->createOperation($storeData);
    }

    /**
     * Display the specified resource.
     */
    public function single($id): Response|ResponseFactory
    {
        return $this->readOperation($id);
    }

    /**
     * Update the specified resource.
     */
    public function update(int $id, ProductCreateRequest $request): Response|ResponseFactory
    {
        $product = $this->repository->findById($id);

        if (! $product) {
            return $this->notFoundResponse();
        }

        if ($request->user()->can('update-product', $product)) {
            return $this->updateOperation($id, $request->validated());
        }

        return $this->forbiddenResponse('Access deny!');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id, Request $request): Response|ResponseFactory
    {
        $product = $this->repository->findById($id);

        if (! $product) {
            return $this->notFoundResponse();
        }

        if ($request->user()->can('delete-product', $product)) {
            return $this->deleteOperation($id);
        }

        return $this->forbiddenResponse('Access deny!');
    }
}
