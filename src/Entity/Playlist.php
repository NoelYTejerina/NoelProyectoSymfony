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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visibilidad = null;

    #[ORM\Column(nullable: true)]
    private ?int $reproducciones = null;

    #[ORM\Column(nullable: true)]
    private ?int $likes = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'Playlists')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Usuario $propietario;

    /**
     * @var Collection<int, UsuarioPlaylist>
     */
    #[ORM\OneToMany(targetEntity: UsuarioPlaylist::class, mappedBy: 'playlist')]
    private Collection $reproduccionesDeUsuario;

    /**
     * @var Collection<int, PlaylistCancion>
     */
    #[ORM\OneToMany(targetEntity: PlaylistCancion::class, mappedBy: 'playlist')]
    private Collection $canciones;

    public function __construct()
    {
        $this->reproduccionesDeUsuario = new ArrayCollection();
        $this->canciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getVisibilidad(): ?string
    {
        return $this->visibilidad;
    }

    public function setVisibilidad(?string $visibilidad)
    {
        $this->visibilidad = $visibilidad;

        return $this;
    }

    public function getReproducciones(): ?int
    {
        return $this->reproducciones;
    }

    public function setReproducciones(?int $reproducciones)
    {
        $this->reproducciones = $reproducciones;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes)
    {
        $this->likes = $likes;

        return $this;
    }

    public function getPropietario(): ?Usuario
    {
        return $this->propietario;
    }

    public function setPropietario(?Usuario $propietario)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * @return Collection<int, UsuarioPlaylist>
     */
    public function getReproduccionesDeUsuario(): Collection
    {
        return $this->reproduccionesDeUsuario;
    }

    public function addReproduccionesDeUsuario(UsuarioPlaylist $reproduccionesDeUsuario)
    {
        if (!$this->reproduccionesDeUsuario->contains($reproduccionesDeUsuario)) {
            $this->reproduccionesDeUsuario->add($reproduccionesDeUsuario);
            $reproduccionesDeUsuario->setPlaylist($this);
        }

        return $this;
    }

    public function removeReproduccionesDeUsuario(UsuarioPlaylist $reproduccionesDeUsuario)
    {
        if ($this->reproduccionesDeUsuario->removeElement($reproduccionesDeUsuario)) {
            // set the owning side to null (unless already changed)
            if ($reproduccionesDeUsuario->getPlaylist() === $this) {
                $reproduccionesDeUsuario->setPlaylist(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, PlaylistCancion>
     */
    public function getCanciones(): Collection
    {
        return $this->canciones;
    }

    public function addCancion(PlaylistCancion $playlistCancion): static
    {
        if (!$this->canciones->contains($playlistCancion)) {
            $this->canciones->add($playlistCancion);
            $playlistCancion->setPlaylist($this);
        }

        return $this;
    }

    public function removeCancion(PlaylistCancion $playlistCancion): static
    {
        if ($this->canciones->removeElement($playlistCancion)) {
            if ($playlistCancion->getPlaylist() === $this) {
                $playlistCancion->setPlaylist(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin nombre';
    }
}
