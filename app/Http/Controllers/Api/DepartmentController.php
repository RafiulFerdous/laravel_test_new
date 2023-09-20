<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use HttpResponses;
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }


    public function index()
    {
        try {
            $department = $this->departmentRepository->getall();

            return $this->success(
                'Brand retrieved successfully',
                $department,
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

            $brand = $this->departmentRepository->create($data);

            return $this->success(
                'Department created successfully',
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


    public function update(Request $request)
    {
        try {
            $data = $request->validate([
                'department_id' => 'required|integer',
                'Challan_num' => 'required|string|max:255',
                'products' => 'required|array',
            ]);

            $departmentId = $data['department_id'];
            $chalanNum = $data['Challan_num'];
            $productsData = $data['products'];

            $this->departmentRepository->addnewdepartmentstock($departmentId, $chalanNum, $productsData);

            return $this->success(
                'Products stock and department updated successfully',
             200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
