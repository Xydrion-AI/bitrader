<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogsController extends AbstractController
{
    #[Route('/blogs', name: 'blogs')]
    public function index(): Response
    {
        return $this->render('pages/blogs/blogs.html.twig', [
            'controller_name' => 'BlogsController',
        ]);
    }

    #[Route('/blog_sidebar', name: 'blog_sidebar')]
    public function blogSide(): Response
    {
        return $this->render('pages/blogs/blog-sidebar.html.twig', [
            'controller_name' => 'BlogsController',
        ]);
    }

    #[Route('/blog_details', name: 'blog_details')]
    public function blogDetails(): Response
    {
        return $this->render('pages/blogs/blog-details.html.twig', [
            'controller_name' => 'BlogsController',
        ]);
    }
}
