<?php declare(strict_types = 1);

namespace Tests\AppBundle\Form;

use AppBundle\Form\AddressBookType;
use AppBundle\Entity\AddressBook;
use Symfony\Component\Form\Test\TypeTestCase;

class AddressBookTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'firstName' => 'Tarique',
            'lastName' => 'Iqbal',
            'email' => 'test.case@domain.com',
            'streetNumber' => 'Falkensteinstraße 1',
            'zip' => '79102',
            'city' => 'Freiburg',
            'country' => 'DE',
            'phoneNumber' => '+4910001110001',
            'birthDate' => '1983-06-01',
            'photo' => null,
        ];

        $addressBookToCompare = new AddressBook();

        $form = $this->factory->create(AddressBookType::class, $addressBookToCompare);

        $addressBook = new AddressBook();
        $addressBook->setFirstName('Tarique');
        $addressBook->setLastName('Iqbal');
        $addressBook->setEmail('test.case@domain.com');
        $addressBook->setStreetNumber('Falkensteinstraße 1');
        $addressBook->setZip('79102');
        $addressBook->setCity('Freiburg');
        $addressBook->setCountry('DE');
        $addressBook->setPhoneNumber('+4910001110001');
        $addressBook->setBirthDate(new \DateTime('1983-06-01'));

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($addressBook, $addressBookToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
