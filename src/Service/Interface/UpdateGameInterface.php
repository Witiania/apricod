<?php

namespace App\Service\Interface;

use App\DTO\RequestDTO;
use App\Entity\Games;

interface UpdateGameInterface
{
    public function update(int $id, RequestDTO $request): Games;
}