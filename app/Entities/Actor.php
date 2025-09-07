<?php

namespace App\Entities;

use AllowDynamicProperties;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entities\Movie;

#[AllowDynamicProperties] #[ORM\Entity]
#[ORM\Table(name: 'actors')]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'actors')]
    private Collection $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getMovies(): Collection
    {
        return $this->movies;
    }
    public function setMovie(): Collection
    {
        return $this->movies;
    }
    public function addMovie(Movie $movie): void
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->addActor($this);
        }
    }

    public function removeMovie(Movie $movie): void
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removeActor($this);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }


}
