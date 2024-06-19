<?php

namespace App\Service;

use App\DTO\RequestDTO;
use App\Entity\Games;

interface CreateGameInterface
{
    public function create(RequestDTO $request): Games;
}