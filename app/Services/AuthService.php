<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{

    private UserRepositoryInterface $userRepository;


    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

public function register(array $data): array
{
    // Hash the password before saving
    $data['password'] = Hash::make($data['password']);

    // Save user through the repository
    $user = $this->userRepository->create($data);

    // Generate Sanctum token
    $token = $user->createToken('API Token')->plainTextToken;

    return [
        'user' => $user,
        'token' => $token,
    ];
}
    public function login(array $credentials): array
{
    $user = $this->userRepository
        ->findByEmail($credentials['email']);


    if (!$user) {
        throw ValidationException::withMessages([
            'email' => [
                'Invalid credentials.'
            ]
        ]);
    }


    if (!Hash::check(
        $credentials['password'],
        $user->password
    )) {
        throw ValidationException::withMessages([
            'email' => [
                'Invalid credentials.'
            ]
        ]);
    }


    $token = $user->createToken(
        'api-token'
    )->plainTextToken;


    return [
        'user' => $user,
        'token' => $token
    ];
}

public function logout($user): void
{
    $user->currentAccessToken()->delete();
}

}
