<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Bag;
use App\Entity\Hero;
use App\Entity\BagItem;
use App\Entity\HeroStat;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserService
 * @package App\Service
 */
class UserService /*implements UserInterface*/
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {
    }

    public function createOrUpdate(
        string $email,
        string $password,
        string $username,
        bool $isSuperAdmin = false,
        bool $isAdmin = false,
        bool $isUser = false
    ): void {
        $user = $this->userRepository->findOneBy(['email' => $email]) ?? new User();

        $user->setEmail($email)
            ->setPassword(
                $this->userPasswordHasher->hashPassword($user, $password)
            );

        if ($isSuperAdmin) {
            $user->addRole(User::SUPER_ADMIN_ROLE);
        }

        if ($isAdmin) {
            $user->addRole(User::ADMIN_ROLE);
        }

        if ($isUser) {
            $user->addRole(User::USER_ROLE);
        }

        if ($user->getHero() === null) {
            $user->setHero(new Hero());
        }

        $user->getHero()->setUsername($username);
        if ($user->getHero()->getHeroStat() !== null) {
            $user->getHero()->setHeroStat(new HeroStat());
            $user->getHero()->setUser($user);
        }

        if ($user->getHero()->getBag() !== null) {
            $user->getHero()->setBag(new Bag());
        }

        $this->userRepository->save($user);
    }
}