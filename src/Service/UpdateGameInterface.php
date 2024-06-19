<?php

namespace App\Service;

use App\DTO\RequestDTO;
use App\Entity\Games;

interface UpdateGameInterface
{
    public function update(int $id, RequestDTO $request): Games;
}