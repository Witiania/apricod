<?php

namespace App\Service;

use App\Entity\Games;
use Doctrine\ORM\EntityManagerInterface;

class GameListService implements GameListInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function list(string $genre): array
    {
        $games = $this->em->getRepository(Games::class)->findByFilter($genre);
        if (!$games) {
            throw new \Exception('Games not found');
        }
        return $games;
    }
}