<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (!$user || !Hash::check($password, $user->password)) {
            return $this->errorResponse(401, 'Email or password invalid', Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        $data = [
            'access_token' => $token
        ];
        return $this->successResponse(200, 'Success', $data, Response::HTTP_OK);
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
//        $request->validate([
//           'email' => 'required'
//        ]);
        $email = $request->get('email');
        $password = $request->get('password');
        $phone = $request->get('phone');
        $name = $request->get('name');
        $this->userRepository->create([
           'email' => $email,
           'password' => Hash::make($password),
            'phone' => $phone,
            'name' => $name
        ]);

        return $this->successResponse(201, 'Success', [], Response::HTTP_CREATED);
    }
}
