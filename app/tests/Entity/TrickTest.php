<?php

namespace App\Test\Entity;

use App\Entity\Trick;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrickTest extends KernelTestCase
{

    public function getEntity(): Trick
    {
        return (new Trick())
            ->setName('Test1')
            ->setDescription('lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quidem.')
            ->setTheme('Basic')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setModifiedAt(new \DateTimeImmutable());
    }

    public function assertHasErrors(Trick $entity, int $errorNumber)
    {
        self::bootKernel();
        $errors = $this->getContainer()->get('validator')->validate($entity);
        $this->assertCount($errorNumber, $errors);
    }

    // test valid trick
    public function testValidTrick()
    {
        $trick = $this->getEntity();
        $this->assertHasErrors($trick, 0);
    }

    // test invalid name
    public function testInvalidName()
    {
        $trick = $this->getEntity();
        $trick->setName('');
        $this->assertHasErrors($trick, 1);
    }

    // test invalid description
    public function testInvalidDescription()
    {
        $trick = $this->getEntity();
        $trick->setDescription('');
        $this->assertHasErrors($trick, 1);
    }

    // test invalid theme
    public function testInvalidTheme()
    {
        $trick = $this->getEntity();
        $trick->setTheme('');
        $this->assertHasErrors($trick, 1);
    }
}
