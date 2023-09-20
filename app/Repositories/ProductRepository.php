<?php

namespace App\Repositories;

interface ProductRepository
{
    public function create(array $data);
    public function getall();
    public function updateProductsWithInvoice(int $invoiceId, array $productData);

}
