<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class EloquentInvoiceRepository implements InvoiceRepository
{
    public function create(array $data)
    {
        return Invoice::create($data);
    }






}
