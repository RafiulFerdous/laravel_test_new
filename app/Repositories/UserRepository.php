<?php

namespace App\Repositories;

interface UserRepository
{
    public function create(array $userData);

    public function findByEmail($email);

}
