<?php

namespace Acme\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddTeacherControllerTest extends WebTestCase
{
    public function testAddteacher()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addteacher');
    }

}
