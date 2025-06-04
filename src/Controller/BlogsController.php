<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogsController extends AbstractController
{
    #[Route('/blogs', name: 'app_blogs')]
    public function index(): Response
    {
        return $this->render('pages/blogs/index.html.twig', [
            'controller_name' => 'BlogsController',
        ]);
    }
}
