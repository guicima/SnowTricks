<?php

namespace App\Test\Entity;

use App\Entity\MediaUrl;
use App\Entity\Trick;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MediaUrlTest extends KernelTestCase
{

    public function getEntity(): MediaUrl
    {
        return (new MediaUrl())
            ->setTrickId(new Trick())
            ->setUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->setMediaType('video');
    }

    public function assertHasErrors(MediaUrl $entity, int $errorNumber)
    {
        self::bootKernel();
        $errors = $this->getContainer()->get('validator')->validate($entity);
        $this->assertCount($errorNumber, $errors);
    }

    // test valid media url
    public function testValidMediaUrl()
    {
        $mediaUrl = $this->getEntity();
        $this->assertHasErrors($mediaUrl, 0);
    }
}
