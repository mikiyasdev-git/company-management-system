<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;

class AuthController extends Controller
{
    use ApiResponse;

    private AuthServiceInterface $authService;


    public function __construct(
        AuthServiceInterface $authService
    )
    {
        $this->authService = $authService;
    }



    public function login(
        LoginRequest $request
    ): JsonResponse
    {

        $result = $this->authService
            ->login(
                $request->validated()
            );


     return $this->success(
    [
        'user' => new UserResource($result['user']),
        'token' => $result['token'],
    ],
    'Login successful'
);

    }

    public function logout(Request $request): JsonResponse
{
    $this->authService->logout($request->user());

    return $this->success(
        null,
        'Logout successful'
    );
}

public function register(
    RegisterRequest $request
): JsonResponse
{
    $result = $this->authService
        ->register(
            $request->validated()
        );

    return $this->success(
        [
            'user' => new UserResource($result['user']),
            'token' => $result['token'],
        ],
        'User registered successfully.',
        201
    );
}

}
