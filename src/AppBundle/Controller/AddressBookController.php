<?php declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/address-book")
 */
class AddressBookController extends AbstractController
{
    /**
     * @Route("/", name="address_book")
     */
    public function index(): Response
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository(AddressBook::class);
        $addressBooks = $repository->findBy([], ['id' => 'DESC']);

        return $this->render('address_book/index.html.twig', [
            'address_books' => $addressBooks
        ]);
    }
}
