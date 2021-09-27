<?php

namespace App\Controller;

use App\Form\UserFormType;
use App\Form\ChangePasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * Class AccountController | file AccountController.php
 *
 * In this class, we have methods for :
 *
 * Displaying the profile page
 * Editing own profile
 * Changing own password
 * 
 */
#[Route('/account')]
class AccountController extends AbstractController
{
    /**
     * Profile page
     *
     * @return Response
     */
    #[Route('', name: 'app_account', methods: ['GET'])]
    public function show(): Response
    {
        return $this->render('account/show.html.twig');
    }

    /**
     * 
     * Edit profile page
     * 
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * 
     */
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/edit', name: 'app_account_edit', methods: ['GET', 'POST'])]
    public function editPassword(EntityManagerInterface $em, Request $request): Response
    {
        $user= $this->getUser();

        $form= $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
           $em->flush();
           $this->addFlash('success', 'Profil modifié avec succès !');

           return $this->redirectToRoute('app_account');
        }
        return $this->render('account/edit.html.twig', [
            'accountForm' => $form->createView()
        ]);
    }
}