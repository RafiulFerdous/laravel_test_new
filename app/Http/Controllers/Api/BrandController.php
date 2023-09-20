<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use HttpResponses;
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }


    public function index()
    {
        try {
            $brand = $this->brandRepository->getall();

            return $this->success(
                'Brand retrieved successfully',
                $brand,
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
                // Add other validation rules for brand data here
            ]);

            $brand = $this->brandRepository->create($data);

            return $this->success(
                'Brand created successfully',
                 $brand
            , 201);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database errors)
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
