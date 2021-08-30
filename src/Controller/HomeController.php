<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        // /* CHECK LOGGIN */
        // if (!$this->getUser()) {
        //     return $this->redirectToRoute('security_login');
        // }

        /* CREATE VIEW */
        return $this->render('home/home.html.twig');
    }
}
