<?php

namespace App\Controller;

use App\Entity\RentalSpaceType;
use App\Form\RentalSpaceTypeFormType;
use App\Repository\RentalSpaceTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class RentalSpaceTypeController | file RentalSpaceTypeController.php
 *
 * In this class, we have method for :
 *
 * C.reate: creating a new rental space with add() method
 * R.ead: displaying the rental spaces with list() method
 * U.pdate: editing rental space with edit() method
 * D.elete: deleting rental space with delete() method
 * 
 */
#[Route('/admin/gestion/types')]
class RentalSpaceTypeController extends AbstractController
{
    /**
     * Rental space management page
     * 
     * List all rental spaces from database
     * Return a page to display them on a (data)table 
     */
    #[Route('/', name: 'rental_space_type_list', methods: ['GET'])]
    public function list(RentalSpaceTypeRepository $rentalSpaceTypeRepository): Response
    {

        return $this->render('gestion/rental_space_type/list.html.twig', [
            'rental_space_types' => $rentalSpaceTypeRepository->findAll(),
        ]);
    }


    /**
     * Rental space management page
     * 
     * Insert a new rental space in the database
     * 
     * Return a page with an empty form
     */
    #[Route('/ajouter', name: 'rental_space_type_add', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        $rentalSpaceType = new RentalSpaceType();
        $form = $this->createForm(RentalSpaceTypeFormType::class, $rentalSpaceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rentalSpaceType);
            $entityManager->flush();

            return $this->redirectToRoute('rental_space_type_list');
        }

        return $this->renderForm('gestion/rental_space_type/add.html.twig', [
            'rental_space_type' => $rentalSpaceType,
            'form' => $form,
        ]);
    }
    
    /**
     * Rental space management page
     * 
     * Editing an existing rental space in the database
     * 
     * Return a page with a fully filled fields form
     */
    #[Route('/{id}/editer', name: 'rental_space_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RentalSpaceType $rentalSpaceType): Response
    {
        $form = $this->createForm(RentalSpaceTypeFormType::class, $rentalSpaceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rental_space_type_list');
        }

        return $this->renderForm('gestion/rental_space_type/edit.html.twig', [
            'rental_space_type' => $rentalSpaceType,
            'form' => $form,
        ]);
    }

    /**
     * Rental space management page
     * 
     * Deleting an existing rental space in the database
     * Verifying CSRF token before deleting
     * 
     * Return a page with a modal confirmation
     */
    #[Route('/{id}/supprimer', name: 'rental_space_type_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, RentalSpaceType $rentalSpaceType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rentalSpaceType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rentalSpaceType);
            $entityManager->flush();
            return $this->redirectToRoute('rental_space_type_list');
        }

        return $this->renderForm('gestion/rental_space_type/delete.html.twig', [
            'rental_space_type' => $rentalSpaceType,
        ]);
    }
}
