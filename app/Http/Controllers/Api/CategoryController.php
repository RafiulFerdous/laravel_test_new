<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Repositories\CategoryRepository;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use HttpResponses;
    protected $ctaegoryrepository;

    public function __construct(CategoryRepository $ctaegoryrepository)
    {
        $this->ctaegoryrepository = $ctaegoryrepository;
    }

    public function index()
    {
        try {
            $cayegory = $this->ctaegoryrepository->getall();

            return $this->success(
                 'CAtegory retrieved successfully',
                 $cayegory,
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
        if ($request->isMethod('post')) {

            try {
                $data = $request->validate([
                    'name' => 'required|string|max:255',

                ]);

                $brand = $this->ctaegoryrepository->create($data);

                return $this->success(
                    'Category created successfully',
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
        else {
            return response()->json([
                'error' => 'Method not allowed',
            ], 405);
        }

    }

}
