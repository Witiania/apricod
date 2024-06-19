<?php

namespace App\Service;

use App\Entity\Games;
use App\Service\Interface\RemoveGameInterface;
use Doctrine\ORM\EntityManagerInterface;

class RemoveGameService implements RemoveGameInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {}

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

        return 'game deleted';
    }
}