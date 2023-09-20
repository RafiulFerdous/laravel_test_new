<?php

namespace App\Repositories;

interface DepartmentRepository
{
    public function create(array $data);
    public function getall();

    public function addnewdepartmentstock(int $departmentId, string $chalanNum, array $productsData);

}
