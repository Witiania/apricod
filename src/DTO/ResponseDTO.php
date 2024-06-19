<?php

namespace App\DTO;

use App\Entity\Games;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ResponseDTO
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $developerStudio = null;
    public array $genres;

    /**
     * @throws ExceptionInterface
     */
    public function __construct(Games $game)
    {
        $this->id = $game->getId();
        $this->name = $game->getName();
        $this->developerStudio = $game->getDeveloperStudio();
        foreach ($game->getGenres() as $genre) {
            $this->genres[$genre->getId()] = $genre->getName();
        }
    }
}