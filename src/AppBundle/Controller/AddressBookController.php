<?php declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Intl;
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

    /**
     * @param int $id
     * @return Response
     *
     * @Route("/show/{id}", name="show_address_book", requirements={"id"="\d+"})
     */
    public function show(int $id): Response
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository(AddressBook::class);
        $addressBook = $repository->find($id);

        if ($addressBook === null) {
            throw $this->createNotFoundException(
                'No Address Book found for id: '.$id
            );
        }

        $countryName = Intl::getRegionBundle()
            ->getCountryName($addressBook->getCountry());

        return $this->render('address_book/show.html.twig', [
            'address_book' => $addressBook,
            'country_name' => $countryName,
        ]);
    }
}
