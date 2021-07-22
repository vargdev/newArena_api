<?php

declare(strict_types=1);

namespace App\DTO\User;

/**
 * Class SyncDTO
 * @package App\DTO\User
 */
class SyncDTO
{
    /**
     * SyncDTO constructor.
     * @param string $email
     * @param string $password
     * @param list<string> $roles
     */
    public function __construct(
        private string $email,
        private string $password,
        private array $roles = []
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}