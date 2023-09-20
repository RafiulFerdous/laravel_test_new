<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;

//use App\Repositories\UserRepositoryInterface;

use App\Repositories\UserRepository;

//use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    use HttpResponses;

//    protected $userRepository;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function login(Request $request)
    {
        $requestBody = json_encode($request->input());


        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validated) {
            $user = $this->userRepository->findByEmail($request->email);

            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->error('Your credentials do not match');
            } else {
                $token = $user->createToken('Api Token of' . $user->email . $user->password)->plainTextToken;


                $data = compact('token', 'user');
                return $this->success('You are successfully logged in', $data);
            }
        }
    }

    public function registration(RegisterRequest $request)
    {
        $userData = $request->validated();

        try {
            $user = $this->userRepository->create($userData);

            return $this->success(
                'User Created Successfully!',
                $user
                , 201);
        } catch (\Throwable $e) {
            return $this->error(
                'Registration failed.'
                , 500);
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You are logged out'
        ];
    }


}
