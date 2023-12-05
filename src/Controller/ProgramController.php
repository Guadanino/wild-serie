<?php

namespace App\Controller;

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

    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);

        $seasons = $program->getSeasons();


        if (!$program) {
            throw $this->createNotFoundException(
                'Aucune série avec le numero : ' . $id . ' trouvé dans la table'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons
        ]);
    }

    #[Route('/{programId}/season/{seasonId}', requirements: ['id' => '\d+'], methods: ['GET'], name: 'season_show')]

    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $seasons = $seasonRepository->findOneBy(['id' => $seasonId]);
        $episode = $episodeRepository->findAll();

        if (!$seasons) {
            throw $this->createNotFoundException(
                'Aucune saison trouvé dans la table'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
            'episode' => $episode,

        ]);
    }

    #[Route('/{programId}/season/{seasonId}/episode/{episodeId}', requirements: ['id' => '\d+'], methods: ['GET'], name: 'episode_show')]

    public function showEpisode(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $seasons = $seasonRepository->findOneBy(['id' => $seasonId]);
        $episode = $episodeRepository->findAll();

        if (!$seasons) {
            throw $this->createNotFoundException(
                'Aucune saison trouvé dans la table'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
            'episode' => $episode,
        ]);
    }
}
