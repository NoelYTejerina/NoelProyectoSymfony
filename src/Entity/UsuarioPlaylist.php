<?php

namespace App\Entity;

use App\Repository\UsuarioPlaylistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioPlaylistRepository::class)]
class UsuarioPlaylist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $reproducida = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'playlistsReproducidas')]
    #[ORM\JoinColumn(nullable:false, onDelete: 'CASCADE')]
    private Usuario $usuario ;

    #[ORM\ManyToOne(targetEntity: Playlist::class, inversedBy: 'reproduccionesDeUsuario')]
    #[ORM\JoinColumn(nullable:false, onDelete: 'CASCADE')]
    private Playlist $playlist ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getReproducida(): ?int
    {
        return $this->reproducida;
    }

    public function setReproducida(int $reproducida)
    {
        $this->reproducida = $reproducida;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario)
    {
        $this->usuario = $usuario;

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

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin nombre';  
    }
}
