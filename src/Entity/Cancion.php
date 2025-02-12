<?php

namespace App\Entity;

use App\Repository\CancionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CancionRepository::class)]
class Cancion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titulo = null;

    #[ORM\Column(nullable: true)]
    private ?int $duracion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $album = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $autor = null;

    #[ORM\Column(nullable: true)]
    private ?int $reproducciones = null;

    #[ORM\Column(nullable: true)]
    private ?int $likes = null;

    #[ORM\Column(length: 255)]
    private ?string $archivo = null;

    #[ORM\ManyToOne(targetEntity: Estilo::class, inversedBy: 'canciones')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?Estilo $genero = null;

    /**
     * @var Collection<int, PlaylistCancion>
     */
    #[ORM\OneToMany(targetEntity: PlaylistCancion::class, mappedBy: 'cancion')]
    private Collection $playlists;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $fecha = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $albumImagen = null;


    public function __construct()
    {
        $this->playlists = new ArrayCollection();
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

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(?int $duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getAlbum(): ?string
    {
        return $this->album;
    }

    public function setAlbum(?string $album)
    {
        $this->album = $album;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor)
    {
        $this->autor = $autor;

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

    public function getGenero(): ?Estilo
    {
        return $this->genero;
    }

    public function setGenero(?Estilo $genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * @return Collection<int, PlaylistCancion>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(PlaylistCancion $playlist)
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->setCancion($this);
        }

        return $this;
    }

    public function removePlaylist(PlaylistCancion $playlist)
    {
        if ($this->playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getCancion() === $this) {
                $playlist->setCancion(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->titulo ?? 'Sin nombre';  
    }

    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    public function setArchivo(string $archivo)
    {
        if (!str_starts_with($archivo, 'songs/')) {
            $archivo = 'songs/' . $archivo;
        }
        
        $this->archivo = $archivo;

        return $this;
    }

    public function getFecha(): ?int
    {
        return $this->fecha;
    }

    public function setFecha(?int $fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getAlbumImagen(): ?string
    {
        return $this->albumImagen;
    }

    public function setAlbumImagen(?string $albumImagen): self
    {
        $this->albumImagen = $albumImagen;

        return $this;
    }
}
