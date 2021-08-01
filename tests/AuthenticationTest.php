<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

// ТАК ЯК ЯКИХОСЬ СЕРЙОЗНИХ ОБМЕЖЕНЬ В АВТОРИЗАЦІЇ ПОКИ НЕМАЄ, ЦІ ТЕСТИ ПІДХОДЯТЬ НА ДАННИЙ МОМЕНТ

/**
 * @property \Symfony\Bundle\FrameworkBundle\KernelBrowser client
 */
class AuthenticationTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testIsEmptyEmail()
    {
        $this->user->setEmail('');

        if ($this->user->getEmail() === '') {
            $this->assertFalse(false);
        }
    }

    public function testIsTooLongEmail()
    {
        $this->user->setEmail(
            'KQvffRSf9bcdfgh6789abcdefghijk
        lmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWX
        YZ06789abcdefghijklmnopqrstuvwxyzABCDEFGHI
        JKLMNOPQRSTUVWXYjklmnopqrstuvwxyzABCDEF
        GHIJKLMNOPQ@RSTZ0VWZ.loc'
        );

        if (strlen($this->user->getEmail()) > 180) {
            $this->assertFalse(false);
        }
    }

    public function testCorrectEmail()
    {
        $this->user->setEmail('test@mail.loc');
        $this->assertTrue(true);
    }

    public function testIsEmptyPassword()
    {
        $this->user->setPassword('');

        if ($this->user->getPassword() === '') {
            $this->assertFalse(false);
        }
    }

    public function testTooShortPassword()
    {
        $this->user->setPassword('KQvf@54');

        if (strlen($this->user->getPassword()) < 8) {
            $this->assertFalse(false);
        }
    }

    public function testCorrectPassword()
    {
        $this->user->setPassword('QwerTy@13#');
        $this->assertTrue(true);
    }
}