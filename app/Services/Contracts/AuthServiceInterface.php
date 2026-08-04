<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface AuthServiceInterface
{
    public function login(array $credentials);
    public function register(array $data): array;
    public function logout($user): void;
}


