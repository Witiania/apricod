<?php

namespace App\Service;

interface RemoveGameInterface
{
    public function remove(int $id): string;
}