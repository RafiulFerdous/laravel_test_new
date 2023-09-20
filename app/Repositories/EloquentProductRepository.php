<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository implements ProductRepository
{
    public function create(array $data)
    {
        return Product::create($data);
    }

    public function getall()
    {
        return Product::all();
    }

    public function updateProductsWithInvoice($invoiceId, $productData)
    {
        try {
            DB::beginTransaction();

            foreach ($productData as $productDatum) {
                $productId = $productDatum['product_id'];

//                $product = Product::findOrFail($productId);

                $product = Product::find($productId);

                if (!$product) {
                    throw new \Exception("Product with ID $productId not found");
                }


                $product->invoice_id = $invoiceId;

                $product->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


}
