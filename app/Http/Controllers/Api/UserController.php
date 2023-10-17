<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

     public function profile() {
        $id = auth()->id();
        $user = $this->userRepository->getProfile($id);
         return $this->successResponse(200, 'success', $user, 200);
     }
}
