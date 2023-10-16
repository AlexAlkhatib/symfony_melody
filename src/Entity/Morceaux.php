<?php

namespace App\Entity;

use App\Repository\MorceauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: MorceauxRepository::class)]
#[Vich\Uploadable]
class Morceaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Assert\NotNull()]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    private ?string $nomMorceaux = null;

    #[Vich\UploadableField(mapping: 'album_image', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'morceau_musique', fileNameProperty: 'musicName')]
    /**
     * ...
     * @Assert\File(mimeTypes={"audio/*"})
     */
    private ?File $musicFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $musicName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\NotNull()]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank()]
    private ?string $artiste = null;

    #[ORM\ManyToOne(inversedBy: 'morceauxes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank()]
    private ?Genre $genreid = null;

    #[ORM\ManyToMany(targetEntity: Playlist::class, mappedBy: 'morceauxid')]
    
    private Collection $playlists;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->artiste.' - '.$this->nomMorceaux;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMorceaux(): ?string
    {
        return $this->nomMorceaux;
    }

    public function setNomMorceaux(string $nomMorceaux): self
    {
        $this->nomMorceaux = $nomMorceaux;

        return $this;
    }

     /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

     /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setMusicFile(?File $musicFile = null): void
    {
        $this->musicFile = $musicFile;

        if (null !== $musicFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getMusicFile(): ?File
    {
        return $this->musicFile;
    }

    public function setMusicName(?string $musicName): void
    {
        $this->musicName = $musicName;
    }

    public function getMusicName(): ?string
    {
        return $this->musicName;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(?\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }

    public function setArtiste(?string $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getGenreid(): ?Genre
    {
        return $this->genreid;
    }

    public function setGenreid(?Genre $genreid): self
    {
        $this->genreid = $genreid;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): self
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->addMorceauxid($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): self
    {
        if ($this->playlists->removeElement($playlist)) {
            $playlist->removeMorceauxid($this);
        }

        return $this;
    }

}
