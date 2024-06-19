<?php

namespace App\Service\Interface;

interface GameListInterface
{
    public function list(string $genre): array;
}