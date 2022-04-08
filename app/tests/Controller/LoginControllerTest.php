<?php

namespace App\Test\Controller;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginControllerTest extends WebTestCase
{

    // test login route
    public function testLoginRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    // test login
    public function testLogin()
    {
        $client = static::createClient();

        $databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $databaseTool->loadAliceFixture([__DIR__ . '/users.yaml']);

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form();
        $form['_username'] = 'john@doe.com';
        $form['_password'] = 'password';
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('/', $client->getResponse()->headers->get('location'));
        $this->assertCount(0, $crawler->filter('html:contains("Invalid credentials.")'));
    }

    // test login with wrong credentials
    // public function testLoginWithWrongCredentials()
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/login');
    //     $crawler = $client->submitForm('Sign in');
    //     $this->assertEquals(302, $client->getResponse()->getStatusCode());
    //     $this->assertGreaterThan(0, $crawler->filter('html:contains("Invalid credentials.")')->count());
    // }

    // test login page content
    public function testLoginPageContent()
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertSelectorTextContains('h1', 'Please sign in');
    }

    // test logout route
    public function testLogoutRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/logout');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
