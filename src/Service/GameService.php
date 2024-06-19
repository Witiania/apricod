<?php

namespace App\Service;

use App\DTO\RequestDTO;
use App\DTO\ResponseDTO;
use App\DTO\ResponseListDTO;
use App\Entity\Games;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class GameService
{

    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function create(RequestDTO $request): ResponseDTO
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
                $this->em->persist($genreEntity);
            } else {
                $genres->add($genreEntity);
            }
        }

        $this->em->persist($game);
        $this->em->flush();

        return new ResponseDTO($game);
    }

    /**
     * @throws \Exception
     * @throws ExceptionInterface
     */
    public function get(int $id): ResponseDTO
    {
        $game = $this->em->getRepository(Games::class)->find($id);
        if (!$game) {
            throw new \Exception('Game not found');
        }

        return new ResponseDTO($game);
    }

    /**
     * @throws \Exception
     */
    public function remove(int $id): string
    {
        $game = $this->em->getRepository(Games::class)->find($id);
        if (!$game) {
            throw new \Exception('Game not found');
        }
        $this->em->remove($game);
        $this->em->flush();

        return 'success';
    }

    /**
     * @throws \Exception
     * @throws ExceptionInterface
     */
    public function update(int $id, RequestDTO $request): ResponseDTO
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

        return new ResponseDTO($game);
    }

    /**
     * @throws \Exception
     * @throws ExceptionInterface
     */
    public function list(string $genre): ResponseListDTO
    {
        $games = $this->em->getRepository(Games::class)->findByFilter($genre);
        if (!$games) {
            throw new \Exception('Games not found');
        }
        return new ResponseListDTO($games);
    }
}