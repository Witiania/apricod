<?php

namespace App\Entity;

use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesRepository::class)]
class Games
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $developerStudio = null;

     #[ORM\JoinTable(name:"genres_to_games")]
    #[ORM\JoinColumn(name:"genre_id",referencedColumnName:"id")]
    #[ORM\InverseJoinColumn(name:"game_id",referencedColumnName:"id")]
    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'games')]
    private ArrayCollection $genres;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDeveloperStudio(): ?string
    {
        return $this->developerStudio;
    }

    public function setDeveloperStudio(string $developerStudio): static
    {
        $this->developerStudio = $developerStudio;

        return $this;
    }

    public function getTags():?ArrayCollection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        $this->genres[] = $genre;
        return $this;
    }
}
