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

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getReproducida(): ?int
    {
        return $this->reproducida;
    }

    public function setReproducida(int $reproducida): static
    {
        $this->reproducida = $reproducida;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }
}
