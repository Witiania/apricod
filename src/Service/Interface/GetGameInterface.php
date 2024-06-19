<?php

namespace App\Service\Interface;

use App\Entity\Games;

interface GetGameInterface
{
    public function get(int $id): Games;
}