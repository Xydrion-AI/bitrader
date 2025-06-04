<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TeamController extends AbstractController
{
    #[Route('/team', name: 'team')]
    public function index(): Response
    {
        return $this->render('pages/team/team.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }

    #[Route('/team-details', name: 'team_details')]
    public function teamDetails(): Response
    {
        return $this->render('pages/team/team-details.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }
}
