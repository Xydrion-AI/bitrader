<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ServicesController extends AbstractController
{
    #[Route('/services', name: 'services')]
    public function services(): Response
    {
        return $this->render('pages/services/services.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    #[Route('/services/details', name: 'service_details')]
    public function serviceDetails(): Response
    {
        return $this->render('pages/services/service-details.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }
}
