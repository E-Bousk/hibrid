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
 * C.: creating a new rental space
 * R.: reading (displaying) the rental space(s) management page
 * U.: updating (editing) an existing rental space
 * D.: deleting an existing rental space
 * 
 */
#[Route('/admin/gestion/espaces')]
class RentalSpaceController extends AbstractController
{
    /**
     * Rental space management page
     * 
     * Reading the data and display them on a table
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
     * Adding a new rental space in the database
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

            return $this->redirectToRoute('rental_space_list');
        }

        return $this->renderForm('rental_space/add.html.twig', [
            'rental_space' => $rentalSpace,
            'form' => $form,
        ]);
    }
    
    /**
     * Rental space management page
     * 
     * Create a form to
     * Editing an existing rental space in the database
     */
    #[Route('/{id}/edit', name: 'rental_space_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RentalSpace $rentalSpace): Response
    {
        $form = $this->createForm(RentalSpaceFormType::class, $rentalSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rental_space_list');
        }

        return $this->renderForm('rental_space/edit.html.twig', [
            'rental_space' => $rentalSpace,
            'form' => $form,
        ]);
    }

    /**
     * Rental space management page
     * 
     * Deleting an existing rental space in the database
     */
    #[Route('/{id}/delete', name: 'rental_space_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, RentalSpace $rentalSpace): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rentalSpace->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rentalSpace);
            $entityManager->flush();
            return $this->redirectToRoute('rental_space_list');
        }

        return $this->renderForm('rental_space/delete.html.twig', [
            'rental_space' => $rentalSpace,
        ]);

    }
}
