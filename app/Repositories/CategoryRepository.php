<?php

namespace App\Repositories;

interface CategoryRepository
{
    public function create(array $data);
    public function getall();

}
