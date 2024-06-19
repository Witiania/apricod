<?php

namespace App\Service;

interface GameListInterface
{
    public function list(string $genre): array;
}