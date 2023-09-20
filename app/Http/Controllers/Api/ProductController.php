<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HttpResponses;
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        try {
            $products = $this->productRepository->getall();

            return $this->success(
                'Product retrieved successfully',
                $products,
                200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'sku' => 'required|string|max:50',
                'brand_id' => 'required|integer',
                'category_id' => 'required|integer',
                'description' => 'nullable|string',
                'usp' => 'nullable|string',
                // Add other validation rules for product data here
            ]);

            $product = $this->productRepository->create($data);

            return $this->success(
                'Product created successfully',
                $product,
                201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
