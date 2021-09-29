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
    #[IsGranted('ROLE_USER')]
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
    #[Route('/edit', name: 'app_account_edit', methods: ['GET', 'PATCH'])]
    public function editPassword(EntityManagerInterface $em, Request $request): Response
    {
        $user= $this->getUser();

        $form= $this->createForm(UserFormType::class, $user, [
            'method' => 'PATCH'
        ]);
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

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/change-password', name: 'app_account_change_password', methods: ['GET', 'PATCH'])]
    /**
     * Change password page
     *
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     */
    public function changePassword(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user= $this->getUser();

        // Option 'current_password_is_required' is used to 
        // discriminate on 'ChangePasswordFormType' what to display
        $form= $this->createForm(ChangePasswordFormType::class, null, [
            'current_password_is_required' => true,
            'method' => 'PATCH'
        ]);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            dump($user);
            dump($form->get('plainPassword')->getData());
            $user->setPassword(
                $passwordHasher->hashPassword($user, $form->get('plainPassword')->getData())
            );
            dd($user->getPassword());
            
            $em->flush();
            $this->addFlash('success', 'Mot de passe modifié avec succès !');

            return $this->redirectToRoute('app_account');
        }
        return $this->render('account/change_password.html.twig', [
            'pswChangeForm' => $form->createView()
        ]);
    }
}
