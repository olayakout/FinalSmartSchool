<?php

namespace Acme\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddStudentControllerTest extends WebTestCase
{
    public function testAddstudent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addstudent');
    }

}
