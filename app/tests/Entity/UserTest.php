<?php

namespace App\Test\Entity;

use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{

    public function getEntity(): User
    {
        return (new User())
            ->setUsername('test1')
            ->setEmail('test@snowtricks.com')
            ->setImageUrl('https://www.snowtricks.com/wp-content/uploads/2019/01/snowtricks-logo-1.png')
            ->setIsVerified(true)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setModifiedAt(new \DateTimeImmutable())
            ->setPassword(
                password_hash('test', PASSWORD_BCRYPT)
            );
    }

    public function assertHasErrors(User $entity, int $errorNumber)
    {
        self::bootKernel();
        $errors = $this->getContainer()->get('validator')->validate($entity);
        $this->assertCount($errorNumber, $errors);
    }

    // test valid user
    public function testValidUser()
    {
        $user = $this->getEntity();
        $this->assertHasErrors($user, 0);
    }

    // test invalid username
    public function testInvalidUsername()
    {
        $user = $this->getEntity();
        $user->setUsername('');
        $this->assertHasErrors($user, 1);
    }

    // test invalid password
    // public function testInvalidPassword()
    // {
    //     $user = $this->getEntity();
    //     $user->setPassword('');
    //     $this->assertHasErrors($user, 1);
    // }

    // test invalid email
    public function testInvalidEmail()
    {
        $user = $this->getEntity();
        $user->setEmail('');
        $this->assertHasErrors($user, 1);
    }
}
