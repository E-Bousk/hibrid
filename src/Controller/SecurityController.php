<?php

namespace App\Controller;

use App\Form\LoginFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController | file SecurityController.php
 *
 * In this class, we have methods for :
 *
 * Displaying the login page
 * Create the login form
 * Logout
 * 
 */
class SecurityController extends AbstractController
{
    /**
     * Set the path
     * Create the login form and the view for the Login Page
     *
     * @param AuthenticationUtils $utils
     * @return Response
     */
    #[Route('/login', name: 'security_login')]
    public function login(AuthenticationUtils $utils): Response
    {
        $userLoggin = $this->getUser();

        if ($userLoggin) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(LoginFormType::class, ['email' => $utils->getLastUsername()]);

        return $this->render('security/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }

    /**
     * Set the path for Logout
     * 
     * @return void
     */
    #[Route('/logout', name: 'security_logout')]
    public function logout() {
    }
}
