<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class EloquentDepartmentRepository implements DepartmentRepository
{
    public function create(array $data)
    {
        return Department::create($data);
    }

    public function getall()
    {
        return Department::all();
    }

    public function addnewdepartmentstock($departmentId, $chalanNum, $productsData)
    {
        try {
            DB::beginTransaction();

            foreach ($productsData as $productData) {
                $productId = $productData['product_id'];
                $quantity = $productData['quantity'];

//                $product = Product::findOrFail($productId);
                $product = Product::find($productId);

                if (!$product) {
                    throw new \Exception("Product with ID $productId not found");
                }


                $product->department_id = $departmentId;
                $product->Challan_num = $chalanNum;
                $product->quantity = $quantity;

                $product->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


}
