<?php

namespace Fan\LawnBotBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebServiceControllerTest extends WebTestCase
{
    public function testCreatelawn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lawn');
    }

    public function testGetlawn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lawn');
    }

    public function testDeletelawn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lawn');
    }

    public function testCreatebot()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lawn/{id}/mower');
    }

    public function testGetbot()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lawn/{id}/mower/{mid}');
    }

    public function testUpdatebot()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lawn/{id}/mower/{mid}');
    }

    public function testDeletebot()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lawn/{id}/mower/{mid}');
    }

    public function testMowlawn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lawn/{id}/execute');
    }

}
