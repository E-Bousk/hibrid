<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class HomeController | file HomeController.php
 *
 * In this class, we have method for :
 *
 * Displaying the main page (homepage)
 * 
 */
class HomeController extends AbstractController
{
    /**
     * Set path for homepage
     * Create view to display the homepage
     * 
     * @return Response
     */
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig');
    }
}
