<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserService
 * @package App\Service
 */

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {
    }

    public function createOrUpdate(
        string $email,
        string $password,
        bool $isSuperAdmin = false
    ): void {
        $user = $this->userRepository->findOneBy(['email' => $email]) ?? new User();

        $user->setEmail($email)
            ->setPassword(
                $this->userPasswordHasher->hashPassword($user, $password)
            )
        ;

        if ($isSuperAdmin) {
            $user->addRole(User::SUPER_ADMIN_ROLE);
        }

        $this->userRepository->save($user);
    }
}