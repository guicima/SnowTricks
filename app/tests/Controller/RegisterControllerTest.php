<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RegisterControllerTest extends WebTestCase
{
    // test register route
    public function testRegisterRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/register');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    // test verify email route
    public function testVerifyEmailUnathorizedRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/verify/email');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $this->assertStringContainsString('/login', $client->getResponse()->headers->get('location'));
    }

    // test register
    // public function testRegister()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/register');
    //     $form = $crawler->selectButton('Register')->form();
    //     $form['registration_form[username]'] = 'admin';
    //     $form['registration_form[email]'] = 'test@snowtricks.com';
    //     $form['registration_form[plainPassword]'] = 'admin';
    //     $client->submit($form);
    // $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

    // $this->assertResponseRedirects('/');
    // $this->assertCount(0, $crawler->filter('html:contains("This value should not be blank.")'));
    // }
}
