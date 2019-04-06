<?php declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AddressBook
 *
 * @ORM\Table(name="address_book")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressBookRepository")
 * @UniqueEntity("email")
 */
class AddressBook
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/[\^<,@\/\{\}\(\)\[\]\!\&\\\`\~\*\$%\?=>:\|;#0-9\x22]+/i",
     *     match=false,
     *     message="Please provide a valid First Name."
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/[\^<,@\/\{\}\(\)\[\]\!\&\\\`\~\*\$%\?=>:\|;#0-9\x22]+/i",
     *     match=false,
     *     message="Please provide a valid Last Name."
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=256, unique=true)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/[\^<@\/\{\}\(\)\[\]\!\&\\\`\~\*\$%\?=>:\|;\x22]+/i",
     *     match=false,
     *     message="Please provide a valid Street and Number."
     * )
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="string", length=56)
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/^([0-9A-Z\ \-]*)$/",
     *     message="Please provide a valid Zip code."
     * )
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=56)
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/[\^<,@\/\{\}\(\)\[\]\!\&\\\`\~\*\$%\?=>:\|;#0-9\x22]+/i",
     *     match=false,
     *     message="Please provide a valid City."
     * )
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\NotBlank
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/^([0-9\(\)\/\+ \-\.]*)$/",
     *     message="Please provide a valid Phone Number."
     * )
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=256, nullable=true)
     * @Assert\Image(
     *     maxSize="2Mi",
     *     maxWidth = 1050,
     *     maxHeight = 1500,
     *      mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif"
     *      }
     * )
     */
    private $photo;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param string $streetNumber
     */
    public function setStreetNumber(string $streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}
