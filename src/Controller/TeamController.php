<?php

namespace App\Controller;

use App\Repository\TeamsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TeamController extends AbstractController
{
    #[Route('/team', name: 'team')]
    public function index(TeamsRepository $repo): Response
    {
        $teamMembers = $repo->findAll(); 

        return $this->render('pages/team/team.html.twig', [
            'teamMembers' => $teamMembers,
        ]);
    }
    
    #[Route('/team/{id}', name: 'team_details')]
    public function teamDetails(TeamsRepository $repo, int $id): Response
    {
        $team = $repo->find($id);

        if (!$team) {
            throw $this->createNotFoundException('Membre de l’équipe introuvable');
        }

        return $this->render('pages/team/team-details.html.twig', [
            'team' => $team,
        ]);
    }
}
