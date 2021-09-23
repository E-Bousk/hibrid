<?php

namespace App\Controller;

use App\Entity\RentalSpaceType;
use App\Form\RentalSpaceTypeFormType;
use App\Security\PreventSqlInjection;
use App\Repository\RentalSpaceTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    public function add(Request $request, PreventSqlInjection $preventSqlInjection, ValidatorInterface $validator, SessionInterface $session): Response
    {
        $rentalSpaceType = new RentalSpaceType();
        $form = $this->createForm(RentalSpaceTypeFormType::class, $rentalSpaceType);
        $form->handleRequest($request);

        /** *************************************
         **         VALIDATION CONTROL         **
         ************************************* */
        $rentalSpaceTypeValidation= $validator->validate($rentalSpaceType);

        /** *************************************
         ** MALICIOUS SQL INJECTION PREVENTION **
        ************************************* */
        // Replace potential malicious code in TYPE
        $designationSafe= $preventSqlInjection->replaceInData($rentalSpaceType->getDesignation());
        $rentalSpaceType->setDesignation($designationSafe);

        // If parameters of request are not empty (filled and submitted form)
        if ($request->request->get('rental_space_type_form')) {
            
            // dd($request->request->get('rental_space_type_form'));

            // get the CSRF token generated on the modal
            $submittedToken = $request->request->get('rental_space_type_form')['_token'];

            // Create a RENTAL SPACE TYPE from RENTAL SPACE TYPE add page
            if ($form->isSubmitted() && $form->isValid()) {

                // dd("1 - Ajout depuis type d'espace locatif");
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($rentalSpaceType);
                $entityManager->flush();
    
                return $this->redirectToRoute('rental_space_type_list');
            }
            
            // Create a RENTAL SPACE TYPE from RENTAL SPACE add page
            if ($form->isSubmitted() && $this->isCsrfTokenValid('rental_space_type_form__token', $submittedToken)) {

                if ($rentalSpaceTypeValidation->count() === 0) {
                    // dd("2 - Ajout depuis l'espace locatif");
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($rentalSpaceType);
                    $entityManager->flush();

                    $session->remove('addedType');
                    $session->set('addedType', $rentalSpaceType->getId());
                    // dd($session->get('addedType'));

                    $this->addFlash("add_success", sprintf("Le type d'espace locatif '%s' à bien été ajouté", $rentalSpaceType));
                    return $this->redirectToRoute('rental_space_add');
                } else {
                    $this->addFlash("add_error", sprintf("Un problème est survenu lors de l'ajout du type d'espace locatif '%s'", $rentalSpaceType));
                    return $this->redirectToRoute('rental_space_add');
                }
            }
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
