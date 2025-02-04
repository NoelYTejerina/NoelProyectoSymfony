<?php

namespace App\Entity;

use App\Repository\EstiloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstiloRepository::class)]
class Estilo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Cancion>
     */
    #[ORM\OneToMany(targetEntity: Cancion::class, mappedBy: 'genero')]
    private Collection $canciones;

    /**
     * @var Collection<int, PerfilEstilo>
     */
    #[ORM\OneToMany(targetEntity: PerfilEstilo::class, mappedBy: 'estilo')]
    private Collection $perfilesSeguidores;

    public function __construct()
    {
        $this->canciones = new ArrayCollection();
        $this->perfilesSeguidores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Cancion>
     */
    public function getCanciones(): Collection
    {
        return $this->canciones;
    }

    public function addCancion(Cancion $cancion): static
    {
        if (!$this->canciones->contains($cancion)) {
            $this->canciones->add($cancion);
            $cancion->setGenero($this);
        }

        return $this;
    }

    public function removeCancion(Cancion $cancion): static
    {
        if ($this->canciones->removeElement($cancion)) {
            
            if ($cancion->getGenero() === $this) {
                $cancion->setGenero(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PerfilEstilo>
     */
    public function getPerfilesSeguidores(): Collection
    {
        return $this->perfilesSeguidores;
    }

    public function addPerfilesSeguidores(PerfilEstilo $perfilSeguidor): static
    {
        if (!$this->perfilesSeguidores->contains($perfilSeguidor)) {
            $this->perfilesSeguidores->add($perfilSeguidor);
            $perfilSeguidor->setEstilo($this);
        }
        return $this;
    }

    public function removePerfilesSeguidores(PerfilEstilo $perfilSeguidor): static
    {
        if ($this->perfilesSeguidores->removeElement($perfilSeguidor)) {
            if ($perfilSeguidor->getEstilo() === $this) {
                $perfilSeguidor->setEstilo(null);
            }
        }
        return $this;
    }

    
    public function __toString(): string
    {
        return $this->nombre ?? 'Sin nombre';  
    }
}
