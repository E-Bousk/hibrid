<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController | file SecurityController.php
 *
 * In this class, we have method for :
 *
 * Displaying the login page
 * Login
 * Logout
 * 
 */
class SecurityController extends AbstractController
{
    /**
     * Login page
     */
    #[Route('/login', name: 'security_login')]
    public function login(AuthenticationUtils $utils): Response
    {
        $userLoggin = $this->getUser();

        if ($userLoggin) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(LoginType::class, ['email' => $utils->getLastUsername()]);

        return $this->render('security/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }

    /**
     * Logout
     */
    #[Route('/logout', name: 'security_logout')]
    public function logout() {
    }
}
