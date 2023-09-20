<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class EloquentUserRepository implements UserRepository
{
    public function create(array $userData)
    {
        try {
            if (isset($userData['image'])) {
                $image = $userData['image'];
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(400, 400)->save('upload/user-profile/' . $name_gen);
                $save_url = 'upload/user-profile/' . $name_gen;
            } else {
                $save_url = 'upload/Avatar/avatar.png';
            }

            $user = new User;
            $user->name = $userData['name'];
            $user->role_id = 1;
            $user->email = $userData['email'];
            $user->image = $save_url;
            $user->password = Hash::make($userData['password']);
            $user->save();

            return $user;
        } catch (\Throwable $e) {

            throw $e;
        }
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }


}
