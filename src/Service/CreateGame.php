<?php

namespace App\Service;

use App\DTO\RequestDTO;
use App\Entity\Games;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;

class CreateGame implements CreateGameInterface
{

    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {
    }

    public function create(RequestDTO $request): Games
    {
        $game = new Games();
        $game->setName($request->name);
        $game->setDeveloperStudio($request->developerStudio);
        $genres = $game->getGenres();

        foreach ($request->genres as $genre) {
            $genreEntity = $this->em->getRepository(Genre::class)->findOneBy(['name' => $genre]);
            if (!$genreEntity) {
                $genreEntity = new Genre();
                $genreEntity->setName($genre);
                $game->addGenre($genreEntity);
                $this->em->persist($genreEntity);
            } else {
                $genres->add($genreEntity);
            }
        }
        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }
}