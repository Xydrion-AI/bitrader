<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AboutUsController extends AbstractController
{
    #[Route('/about_us', name: 'app_about_us')]
    public function index(): Response
    {
        return $this->render('pages/about_us/index.html.twig', [
            'controller_name' => 'AboutUs',
        ]);
    }
}
