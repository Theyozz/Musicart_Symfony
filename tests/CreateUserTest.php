<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    public function testCreateUser(): void
    {
        $user = new User();
        $user->setFirstname("Firstname");
        $user->setLastname("Lastname");
        $user->setPassword('password');

        $this->assertEquals('Firstname', $user->getFirstname());
        $this->assertEquals('Lastname', $user->getLastname());
        $this->assertEquals('password', $user->getPassword());
    }
}
