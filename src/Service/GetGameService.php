<?php

namespace App\Service;

use App\Entity\Games;
use App\Repository\GamesRepository;

class GetGameService implements GetGameInterface
{
    public function __construct(
        private readonly GamesRepository $ge
    ){}

    /**
     * @throws \Exception
     */
    public function get(int $id): Games
    {
        $game = $this->ge->find($id);
        if (!$game) {
            throw new \Exception('Game not found');
        }

        return $game;
    }
}