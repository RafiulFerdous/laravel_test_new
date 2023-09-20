<?php

namespace App\Repositories;

use App\Models\Category;

class EloquentCategoryRepository implements CategoryRepository
{
    public function create(array $data)
    {
        return Category::create($data);
    }

    public function getall()
    {
        return Category::all();
    }


}
