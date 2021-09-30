<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccountController | file AccountController.php
 *
 * In this class, we have methods for :
 *
 * Displaying the admin dashboard page
 * 
 */
class AdminDashboardController extends AbstractController
{
    /**
     * Admin dashboard page
     *
     * @return Response
     */
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function index(): Response
    {
        return $this->render('admin_dashboard/index.html.twig');
    }
}
