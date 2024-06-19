<?php

namespace App\Service;

use App\Entity\Games;

interface GetGameInterface
{
    public function get(int $id): Games;
}