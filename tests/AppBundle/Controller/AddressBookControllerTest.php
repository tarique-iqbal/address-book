<?php declare(strict_types = 1);

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\DataFixtures\DataFixtureTestCase;

class AddressBookControllerTest extends DataFixtureTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $link = $crawler->filter('a:contains("Address Book List")')->link();
        $client->click($link);

        $this->assertContains('/address-book/', $client->getRequest()->getUri());
        $this->assertEquals(10, $client->getCrawler()->filter('a:contains("Details")')->count());
        $this->assertEquals(10, $client->getCrawler()->filter('a:contains("Edit")')->count());
        $this->assertEquals(10, $client->getCrawler()->filter('a:contains("Delete")')->count());
    }
}
