<?php

namespace App\Controller;

use App\Entity\RentalSpace;
use App\Form\RentalSpaceFormType;
use App\Repository\RentalSpaceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class RentalSpaceController | file RentalSpaceController.php
 *
 * In this class, we have methods for :
 *
 * C.reate: creating a new rental space with add() method
 * R.ead: displaying the rental spaces with list() method
 * U.pdate: editing rental space with edit() method
 * D.elete: deleting rental space with delete() method
 * 
 */
#[Route('/admin/gestion/espaces')]
class RentalSpaceController extends AbstractController
{
    /**
     * Rental space management page
     * 
     * List all rental spaces from database
     * Return a page to display them on a (data)table
     *
     * @param RentalSpaceRepository $rentalSpaceRepository
     * @return Response
     */
    #[Route('', name: 'rental_space_list', methods: ['GET'])]
    public function list(RentalSpaceRepository $rentalSpaceRepository): Response
    {

        return $this->render('gestion/rental_space/list.html.twig', [
            'rental_spaces' => $rentalSpaceRepository->findAll(),
        ]);
    }

    /**
     * Rental space management page
     * 
     * Insert a new rental space in the database
     * Return a page with an empty form
     *
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    #[Route('/ajouter', name: 'rental_space_add', methods: ['GET', 'POST'])]
    public function add(Request $request, SessionInterface $session): Response
    {
        $rentalSpace = new RentalSpace();
        $form = $this->createForm(RentalSpaceFormType::class, $rentalSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rentalSpace);
            $entityManager->flush();

            // delete (potential) IDs stored in SESSION
            // dd($session->get('addedCity'), $session->get('addedType'));
            $session->remove('addedCity');
            $session->remove('addedType');

            return $this->redirectToRoute('rental_space_list');
        }

        return $this->renderForm('gestion/rental_space/add.html.twig', [
            'rental_space' => $rentalSpace,
            'form' => $form,
        ]);
    }
    
    /**
     * Rental space management page
     * 
     * Editing an existing rental space in the database
     * Return a page with a fully filled fields form
     * 
     * @param Request $request
     * @param RentalSpace $rentalSpace
     * @return Response
     */
    #[Route('/{id}/editer', name: 'rental_space_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RentalSpace $rentalSpace): Response
    {
        $form = $this->createForm(RentalSpaceFormType::class, $rentalSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rental_space_list');
        }

        return $this->renderForm('gestion/rental_space/edit.html.twig', [
            'rental_space' => $rentalSpace,
            'form' => $form,
        ]);
    }

    /**
     * Rental space management page
     * 
     * Deleting an existing rental space in the database
     * Verifying CSRF token before deleting
     * Return a page with a modal confirmation
     * 
     * @param Request $request
     * @param RentalSpace $rentalSpace
     * @return Response
     */
    #[Route('/{id}/supprimer', name: 'rental_space_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, RentalSpace $rentalSpace): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rentalSpace->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rentalSpace);
            $entityManager->flush();
            return $this->redirectToRoute('rental_space_list');
        }

        return $this->renderForm('gestion/rental_space/delete.html.twig', [
            'rental_space' => $rentalSpace,
        ]);
    }
}
