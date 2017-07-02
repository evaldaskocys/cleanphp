<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTaskControllerTest extends WebTestCase
{
    public function testListInJson()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/task/list', [], [], ['HTTP_X-AUTH-TOKEN' => 'JEDI']);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-Type'));
    }

    public function testListInXml()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/task/list.xml', [], [], ['HTTP_X-AUTH-TOKEN' => 'JEDI']);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
}
