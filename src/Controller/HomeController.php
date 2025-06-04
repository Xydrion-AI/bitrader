<?php

namespace App\Controller;

use App\Repository\TeamsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
public function index(TeamsRepository $repo): Response
{
    $teamMembers = $repo->findAll();

    return $this->render('pages/home/home.html.twig', [
        'controller_name' => 'HomeController',
        'teamMembers' => $teamMembers,
    ]);
}

}
