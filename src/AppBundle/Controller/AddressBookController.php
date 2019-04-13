<?php declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use AppBundle\Form\AddressBookType;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/address-book")
 */
class AddressBookController extends AbstractController
{
    /**
     * @var string
     */
    private $photoDirectory;

    /**
     * AddressBookController constructor.
     * @param string $photoDirectory
     */
    public function __construct(string $photoDirectory)
    {
        $this->photoDirectory = $photoDirectory;
    }

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

    /**
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     *
     * @Route("/add", name="add_address_book")
     */
    public function add(Request $request, FileUploader $fileUploader): Response
    {
        $addressBook = new AddressBook();

        $form = $this->createForm(AddressBookType::class, $addressBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addressBook = $form->getData();
            $photo = $addressBook->getPhoto();

            if ($photo instanceof UploadedFile) {
                $fileName = $fileUploader->upload($this->photoDirectory, $photo);
                $addressBook->setPhoto($fileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addressBook);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Address Book has been added successfully.'
            );

            return $this->redirectToRoute('address_book');
        }

        return $this->render('address_book/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param AddressBook $addressBook
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     *
     * @Route("/edit/{id}", name="edit_address_book", requirements={"id"="\d+"})
     */
    public function edit(AddressBook $addressBook, Request $request, FileUploader $fileUploader): Response
    {
        if ($addressBook->getPhoto() !== null) {
            $addressBook->setPhoto(new File($this->photoDirectory . '/' . $addressBook->getPhoto()));
        }

        $form = $this->createForm(AddressBookType::class, $addressBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addressBook = $form->getData();
            $photo = $addressBook->getPhoto();

            if ($photo instanceof UploadedFile) {
                $fileName = $fileUploader->upload($this->photoDirectory, $photo);
                $addressBook->setPhoto($fileName);
            } elseif ($photo instanceof File) {
                $addressBook->setPhoto($photo->getFilename());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($addressBook);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Address Book has been updated successfully.'
            );

            return $this->redirectToRoute('address_book');
        }

        return $this->render('address_book/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
