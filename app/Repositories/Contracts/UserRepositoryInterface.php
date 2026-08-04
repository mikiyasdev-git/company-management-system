<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find user by email address.
     */
    public function findByEmail(string $email);
}
