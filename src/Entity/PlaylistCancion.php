<?php

namespace App\Entity;

use App\Repository\PlaylistCancionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistCancionRepository::class)]
class PlaylistCancion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  
    #[ORM\ManyToOne(targetEntity:Playlist::class, inversedBy: 'canciones')]
    #[ORM\JoinColumn(nullable:false, onDelete: 'CASCADE')]
    private Playlist $playlist ;

    #[ORM\ManyToOne(targetEntity:Cancion::class,inversedBy: 'playlists')]
    #[ORM\JoinColumn(nullable:false, onDelete: 'CASCADE')]
    private Cancion $cancion ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist)
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getCancion(): ?Cancion
    {
        return $this->cancion;
    }

    public function setCancion(?Cancion $cancion)
    {
        $this->cancion = $cancion;

        return $this;
    }
    public function __toString(): string
    {
        return $this->nombre ?? 'Sin nombre';  
    }
}
