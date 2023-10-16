<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPlaylist = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbMorceaux = null;

    #[ORM\ManyToMany(targetEntity: Morceaux::class, inversedBy: 'playlists')]
    private Collection $morceauxid;

    #[ORM\ManyToOne(inversedBy: 'playlists')]
    private ?User $userid = null;

    public function __construct()
    {
        $this->morceauxid = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nomPlaylist;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlaylist(): ?string
    {
        return $this->nomPlaylist;
    }

    public function setNomPlaylist(string $nomPlaylist): self
    {
        $this->nomPlaylist = $nomPlaylist;

        return $this;
    }

    public function getNbMorceaux(): ?int
    {
        return $this->nbMorceaux;
    }

    public function setNbMorceaux(?int $nbMorceaux): self
    {
        $this->nbMorceaux = $nbMorceaux;

        return $this;
    }

    /**
     * @return Collection<int, Morceaux>
     */
    public function getMorceauxid(): Collection
    {
        return $this->morceauxid;
    }

    public function addMorceauxid(Morceaux $morceauxid): self
    {
        if (!$this->morceauxid->contains($morceauxid)) {
            $this->morceauxid->add($morceauxid);
        }

        return $this;
    }

    public function removeMorceauxid(Morceaux $morceauxid): self
    {
        $this->morceauxid->removeElement($morceauxid);

        return $this;
    }

    public function getUserid(): ?User
    {
        return $this->userid;
    }

    public function setUserid(?User $userid): self
    {
        $this->userid = $userid;

        return $this;
    }
}
