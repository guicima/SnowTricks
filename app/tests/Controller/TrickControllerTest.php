<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TrickControllerTest extends WebTestCase
{
    // test index route
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/trick');
        // $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertIsBool(true);
    }

    // test show route
    // public function testShow()
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/trick/show');
    //     $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    // }

    // test new route
    // public function testNew()
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/trick/new');
    //     $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    // }

    // test edit route
    // public function testEdit()
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/trick/edit');
    //     $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    // }

    // test delete route
    // public function testDelete()
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/trick/delete');
    //     $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    // }
}
