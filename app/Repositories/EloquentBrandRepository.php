<?php

namespace App\Repositories;

use App\Models\Brand;

class EloquentBrandRepository implements BrandRepository
{
    public function create(array $data)
    {
        return Brand::create($data);
    }

    public function getall()
    {
        return Brand::all();
    }


}
