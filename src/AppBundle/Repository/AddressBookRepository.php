<?php declare(strict_types = 1);

namespace AppBundle\Repository;

use AppBundle\Entity\AddressBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class AddressBookRepository
 * @package AppBundle\Repository
 *
 * @method AddressBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressBook[] findAll()
 * @method AddressBook[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressBookRepository extends ServiceEntityRepository
{
    /**
     * AddressBookRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AddressBook::class);
    }
}
