<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomGenre = null;

    #[ORM\OneToMany(mappedBy: 'genreid', targetEntity: Morceaux::class)]
    private Collection $morceauxes;

    public function __construct()
    {
        $this->morceauxes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nomGenre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGenre(): ?string
    {
        return $this->nomGenre;
    }

    public function setNomGenre(string $nomGenre): self
    {
        $this->nomGenre = $nomGenre;

        return $this;
    }

    /**
     * @return Collection<int, Morceaux>
     */
    public function getMorceauxes(): Collection
    {
        return $this->morceauxes;
    }

    public function addMorceaux(Morceaux $morceaux): self
    {
        if (!$this->morceauxes->contains($morceaux)) {
            $this->morceauxes->add($morceaux);
            $morceaux->setGenreid($this);
        }

        return $this;
    }

    public function removeMorceaux(Morceaux $morceaux): self
    {
        if ($this->morceauxes->removeElement($morceaux)) {
            // set the owning side to null (unless already changed)
            if ($morceaux->getGenreid() === $this) {
                $morceaux->setGenreid(null);
            }
        }

        return $this;
    }
}
