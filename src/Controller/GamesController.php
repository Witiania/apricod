<?php

namespace App\Controller;

use App\DTO\RequestDTO;
use App\Entity\Games;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class GamesController extends AbstractController
{
    public function __invoke(
        #[MapRequestPayload] RequestDTO $requestDTO,
    )
    {

    }
    #[Route('/', name: 'app_games', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] RequestDTO $request,
        EntityManagerInterface $em): JsonResponse
    {
        $game = new Games();
        $game->setName($request['name']);
        $game->setDeveloperStudio($request['developerStudio']);
        $genres =  $game->getGenres();

        foreach ($request['genres'] as $genre) {
            $genreEntity = $em->getRepository(Genre::class)->findOneBy(['name' => $genre]);
            if(!$genreEntity) {
                $genreEntity = new Genre();
                $genreEntity->setName($genre);
                $em->persist($genreEntity);
            }else{
                $genres->add($genreEntity);
            }
        }

        $em->persist($game);
        $em->flush();
        return $this->json($game)->setStatusCode(201);
    }
}