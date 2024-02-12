<?php

namespace Sajadsdi\Marketplace\Http\Controllers\API\V1\Products;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Sajadsdi\Marketplace\Http\Controllers\API\V1\BaseApiController;
use Sajadsdi\Marketplace\Http\Requests\API\V1\Products\ProductPhotoCreateRequest;
use Sajadsdi\Marketplace\Repository\product\ProductPhotoRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Sajadsdi\Marketplace\Repository\Product\ProductRepositoryInterface;

class ProductPhotoController extends BaseApiController
{

    public function __construct(ProductPhotoRepository $productPhotoRepository)
    {
        $this->repository = $productPhotoRepository;
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
    public function store($productId, ProductPhotoCreateRequest $request, ProductRepositoryInterface $productRepository): Response|ResponseFactory
    {
        $product = $productRepository->findById($productId);

        if (! $product) {
            return $this->notFoundResponse();
        }

        if ($request->user()->can('update-product', $product)) {
            //resize image before save
            $imageManager = new ImageManager(new Driver());
            $image        = $imageManager->read($request->file('photo'))->scale(config('marketplace.product_photo_width'));

            $disk = config('marketplace.upload_disk');

            if (! Storage::disk($disk)->exists('product_photos')) {
                Storage::disk($disk)->makeDirectory('product_photos');
            }

            // create unique file name
            $filename = 'product_photos/' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            Storage::disk($disk)->put($filename, $image->encode());

            return $this->createOperation(['product_id' => $product->id, 'path' => $filename, 'disk' => $disk]);
        }

        return $this->forbiddenResponse('Access deny!');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($productId, $id, Request $request, ProductRepositoryInterface $productRepository): Response|ResponseFactory
    {
        $product = $productRepository->findById($productId);
        $photo   = $this->repository->findById($id);

        if (! $product || ! $photo) {
            return $this->notFoundResponse();
        }

        if ($request->user()->can('delete-product-photo', $product)) {
            Storage::disk($photo->disk)->delete($photo->path);

            return $this->deleteOperation($id);
        }

        return $this->forbiddenResponse('Access deny!');
    }
}
