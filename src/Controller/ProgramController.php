<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]

    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    #[Route('/show/{id}', requirements: ['id' => '\d+'], methods: ['GET'], name: 'show')]

    public function show(Program $program): Response
    {

        $seasons = $program->getSeasons();


        if (!$program) {
            throw $this->createNotFoundException(
                'Aucune série avec le numero : ' . $program['id'] . ' trouvé dans la table'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons
        ]);
    }

    #[Route('/{program}/season/{season}', requirements: ['id' => '\d+'], methods: ['GET'], name: 'season_show')]

    public function showSeason(Program $program, Season $season): Response
    {
        $episodes = $season->getEpisodes();

        if (!$season) {
            throw $this->createNotFoundException(
                'Aucune saison trouvé dans la table'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes

        ]);
    }

    #[Route('/{program}/season/{season}/episode/{episode}', requirements: ['id' => '\d+'], methods: ['GET'], name: 'episode_show')]

    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        if (!$season) {
            throw $this->createNotFoundException(
                'Aucune saison trouvé dans la table'
            );
        }
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}
