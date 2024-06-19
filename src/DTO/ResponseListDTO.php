<?php

namespace App\DTO;

use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ResponseListDTO
{
    public array $games;

    /**
     * @throws ExceptionInterface
     */
    public function __construct(array $games)
    {
        foreach ($games as $game) {
            $this->games[] = new ResponseDTO($game);
        }
    }
}