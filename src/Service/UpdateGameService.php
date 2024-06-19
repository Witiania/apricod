<?php

namespace App\Service;

use App\DTO\RequestDTO;
use App\Entity\Games;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;

class UpdateGameService implements UpdateGameInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {}

    /**
     * @throws \Exception
     */
    public function update(int $id, RequestDTO $request): Games
    {
        $game = $this->em->getRepository(Games::class)->find($id);
        if (!$game) {
            throw new \Exception('Game not found');
        }
        $game->setName($request->name);
        $game->setDeveloperStudio($request->developerStudio);

        $existingGenres = $game->getGenres();
        $newGenres = $request->genres;

        // Удаляем старые жанры
        foreach ($existingGenres as $existingGenre) {
            if (!in_array($existingGenre->getName(), $newGenres, true)) {
                $game->removeGenre($existingGenre);
            }
        }

        // Добавляем новые жанры
        foreach ($newGenres as $genreName) {
            $genreEntity = $this->em->getRepository(Genre::class)->findOneBy(['name' => $genreName]);
            if (!$genreEntity) {
                $genreEntity = new Genre();
                $genreEntity->setName($genreName);
                $this->em->persist($genreEntity);
            }
            if (!$game->getGenres()->contains($genreEntity)) {
                $game->addGenre($genreEntity);
            }
        }

        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }
}