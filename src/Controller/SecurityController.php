<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security_login')]
    public function login(AuthenticationUtils $utils): Response
    {
        $userLoggin = $this->getUser();

        if ($userLoggin) {
            return $this->redirectToRoute('homepage');
        }

        /* to create the form to login (and on error, keep the email on the inputform) */
        $form = $this->createForm(LoginType::class, ['email' => $utils->getLastUsername()]);

        /* show the form and the error (if exist) */
        return $this->render('security/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }

    #[Route('/logout', name: 'security_logout')]
    public function logout() {
    }
}
