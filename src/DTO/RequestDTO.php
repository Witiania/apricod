<?php

namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class RequestDTO
{
    #[Assert\Type('string')]
    public ?string $name = null;

    #[Assert\Type('string')]
    public ?string $developerStudio = null;

    #[Assert\Type('array')]
    public ?array $genres = null;
}