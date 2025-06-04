<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PriceController extends AbstractController
{
    #[Route('/price', name: 'price')]
    public function index(): Response
    {
        return $this->render('pages/price/price.html.twig', [
            'controller_name' => 'PriceController',
        ]);
    }
}
