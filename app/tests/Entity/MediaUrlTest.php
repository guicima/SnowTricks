<?php

namespace App\Test\Entity;

use App\Entity\Image;
use App\Entity\Trick;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ImageTest extends KernelTestCase
{

    public function getEntity(): Image
    {
        return (new Image())
            ->setTrick(new Trick())
            ->setName('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->setType('video');
    }

    public function assertHasErrors(Image $entity, int $errorNumber)
    {
        self::bootKernel();
        $errors = $this->getContainer()->get('validator')->validate($entity);
        $this->assertCount($errorNumber, $errors);
    }

    // test valid media url
    public function testValidImage()
    {
        $image = $this->getEntity();
        $this->assertHasErrors($image, 0);
    }
}
