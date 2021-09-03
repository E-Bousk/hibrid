<?php

namespace App\Controller;

use App\Entity\RentalSpace;
use App\Form\RentalSpaceFormType;
use App\Repository\RentalSpaceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class RentalSpaceController | file RentalSpaceController.php
 *
 * In this class, we have method for :
 *
 * Displaying the rental space management page
 * create a new rental space
 * edit existing rental space
 * delete existing rental space
 * 
 */
#[Route('admin/gestion/espaces')]
class RentalSpaceController extends AbstractController
{
    /**
     * Rental space management page
     * 
     * Read the data and display on a table
     */
    #[Route('/', name: 'rental_space_list', methods: ['GET'])]
    public function list(RentalSpaceRepository $rentalSpaceRepository): Response
    {

        return $this->render('rental_space/list.html.twig', [
            'rental_spaces' => $rentalSpaceRepository->findAll(),
        ]);
    }


    /**
     * Rental space management page
     * 
     * Create a form to
     * Add a new rental space in the database
     */
    #[Route('/ajouter', name: 'rental_space_add', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        $rentalSpace = new RentalSpace();
        $form = $this->createForm(RentalSpaceFormType::class, $rentalSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rentalSpace);
            $entityManager->flush();

            return $this->redirectToRoute('rental_space_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rental_space/add.html.twig', [
            'rental_space' => $rentalSpace,
            'form' => $form,
        ]);
    }
    
}
