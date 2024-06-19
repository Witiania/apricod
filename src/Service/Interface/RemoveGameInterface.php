<?php

namespace App\Service\Interface;

interface RemoveGameInterface
{
    public function remove(int $id): string;
}