<?php declare(strict_types = 1);

namespace Tests\AppBundle\Repository;

use AppBundle\DataFixtures\AddressBookFixtures;
use AppBundle\Entity\AddressBook;
use Tests\AppBundle\DataFixtures\DataFixtureTestCase;

class AddressBookRepositoryTest extends DataFixtureTestCase
{
    public function setUp()
    {
        parent::setUp();

        $fixture = new AddressBookFixtures();
        $fixture->load($this->entityManager);
    }

    public function testFind()
    {
        $addressBookRepository = $this
            ->entityManager
            ->getRepository(AddressBook::class);

        $addressBooks = $addressBookRepository->find(1);

        $this->assertEquals(1, count($addressBooks));
        $this->assertInstanceOf(AddressBook::class, $addressBooks);
    }

    public function testFindAll()
    {
        $addressBookRepository = $this
            ->entityManager
            ->getRepository(AddressBook::class);

        $addressBooks = $addressBookRepository->findAll();
        $this->assertEquals(10, count($addressBooks));
    }
}
