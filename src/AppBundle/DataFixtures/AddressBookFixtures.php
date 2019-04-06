<?php declare(strict_types = 1);

namespace AppBundle\DataFixtures;

use AppBundle\Entity\AddressBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AddressBooksFixtures
 * @package AppBundle\DataFixtures
 */
class AddressBookFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $addressBook = new AddressBook();
            $addressBook->setFirstName('First' . chr(rand(97, 122)));
            $addressBook->setLastName('Last' . chr(rand(97, 122)));
            $addressBook->setEmail(
                chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122)) . '.email@domain.com'
            );
            $addressBook->setStreetNumber('Junkerfeldele ' . $i);
            $addressBook->setZip('79211');
            $addressBook->setCity('Denzlingen');
            $addressBook->setCountry('DE');
            $addressBook->setPhoneNumber('+491000111000' . rand(1, 9));
            $addressBook->setBirthDate(new \DateTime('1983-06-' . rand(10, 30)));

            if ($i % 2 === 0) {
                $addressBook->setPhoto(md5(uniqid()) . '.jpeg');
            }

            $manager->persist($addressBook);
        }

        $manager->flush();
    }
}
