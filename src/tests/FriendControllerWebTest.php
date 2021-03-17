<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FriendControllerWebTest extends WebTestCase
{
    public function testFriendsAction()
    {
        $client = static::createClient();

        $client->request('GET', '/friends');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSetfriendshipValueAction()
    {
        $client = static::createClient();

        $client->request('GET', '/setfriendshipvalue/joe/100');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/setfriendshipvalue/noexistentusername/100');
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }

    public function testEatenAction()
    {
        $client = static::createClient();

        $client->request('GET', '/eaten');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testnewAction()
    {
        $client = static::createClient();

        $client->request('PUT', '/friend');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }
}