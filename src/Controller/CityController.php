<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityFormType;
use App\Repository\CityRepository;
use App\Security\PreventSqlInjection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class CityController | file CityController.php
 *
 * In this class, we have methods for :
 *
 * C.reate: creating a new city with add() method
 * R.ead: displaying the cities with list() method
 * U.pdate: editing city with edit() method
 * D.elete: deleting city with delete() method
 * 
 */
#[Route('/admin/gestion/villes')]
class CityController extends AbstractController
{
    private $preventSqlInjection;

    public function __construct(PreventSqlInjection $preventSqlInjection)
    {
        $this->preventSqlInjection= $preventSqlInjection;
    }

    /**
     * City management page
     * 
     * List all cities from database
     * Return a page to display them on a (data)table 
     *
     * @param CityRepository $cityRepository
     * @return Response
     */
    #[Route('', name: 'city_list', methods: ['GET'])]
    public function list(CityRepository $cityRepository): Response
    {

        return $this->render('gestion/city/list.html.twig', [
            'cities' => $cityRepository->findAll(),
        ]);
    }

    /**
     * City management page
     * 
     * Insert a new city in the database
     * Return a page with an empty form
     * 
     * @param Request $request
     * @param PreventSqlInjection $preventSqlInjection
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @return Response
     */
    #[Route('/ajouter', name: 'city_add', methods: ['GET', 'POST'])]
    public function add(Request $request, ValidatorInterface $validator, SessionInterface $session): Response
    {
        $city = new City();
        $form = $this->createForm(CityFormType::class, $city);
        $form->handleRequest($request);

        /** *************************************
         **         VALIDATION CONTROL         **
         ************************************* */
        $cityValidation= $validator->validate($city);
        // dd($cityValidation);

        /** *************************************
         ** MALICIOUS SQL INJECTION PREVENTION **
         ************************************* */
        // Replace potential malicious code in NAME
        $city->setName($this->preventSqlInjection->replaceInData($city->getName()));
        
        // If parameters of request are not empty (filled and submitted form)
        if ($request->request->get('city_form')) {

            // dd($request->request->get('city_form'));

            // get the CSRF token generated on the modal
            $submittedToken = $request->request->get('city_form')['_token'];

            // Create a CITY from CITY add page
            if ($form->isSubmitted() && $form->isValid()) {

                // dd("1 - Ajout depuis ville");
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($city);
                $entityManager->flush();
    
                return $this->redirectToRoute('city_list');
            }

            // Create a CITY from RENTAL SPACE add page
            if ($form->isSubmitted() && $this->isCsrfTokenValid('city_form__token', $submittedToken)) {

                if ($cityValidation->count() === 0) {
                    // dd("2 - Ajout depuis l'espace locatif");
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($city);
                    $entityManager->flush();
                    
                    // Store the new ID on SESSION to get this city on SELECT on the RENTAL SPACE add page
                    $session->remove('addedCity');
                    $session->set('addedCity', $city->getId());
                    // dd($session->get('addedCity'));
                    
                    $this->addFlash("add_success", sprintf("La ville '%s' (%s) à bien été ajoutée", $city->getName(), $city->getPostalCode()));
                    return $this->redirectToRoute('rental_space_add');
                } else {
                    $this->addFlash("add_error",  sprintf("Un problème est survenu lors de l'ajout de la ville '%s' (%s)", $city->getName(), $city->getPostalCode()));
                    return $this->redirectToRoute('rental_space_add');
                }
            }
        }

        return $this->renderForm('gestion/city/add.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }
    
    /**
     * City management page
     * 
     * Editing an existing city in the database
     * Return a page with a fully filled fields form
     * 
     * @param Request $request
     * @param City $city
     * @return Response
     */
    #[Route('/{id}/editer', name: 'city_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, City $city): Response
    {
        // to get restored string on the edit form
        $city->setName($this->preventSqlInjection->restoreData($city->getName()));
        $form = $this->createForm(CityFormType::class, $city);
        // to get correct dispaly on the delete confirmation modal window
        $city->setName($this->preventSqlInjection->replaceInData($city->getName()));

        $form->handleRequest($request);

        // dd($city);

        if ($form->isSubmitted() && $form->isValid()) {

            /** *************************************
             ** MALICIOUS SQL INJECTION PREVENTION **
             ************************************* */
            $city->setName($this->preventSqlInjection->replaceInData($city->getName()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('city_list');
        }

        return $this->renderForm('gestion/city/edit.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * City management page
     * 
     * Deleting an existing city in the database
     * Verifying CSRF token before deleting
     * Return a page with a modal confirmation
     * 
     * @param Request $request
     * @param City $city
     * @return Response
     */
    #[Route('/{id}/supprimer', name: 'city_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, City $city): Response
    {
        if ($this->isCsrfTokenValid('delete'.$city->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($city);
            $entityManager->flush();
            return $this->redirectToRoute('city_list');
        }

        return $this->renderForm('gestion/city/delete.html.twig', [
            'city' => $city,
        ]);
    }
}
