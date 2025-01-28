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

    #[ORM\ManyToOne(inversedBy: 'estiloMusicalPreferido')]
    private ?Perfil $perfil = null;

    /**
     * @var Collection<int, Cancion>
     */
    #[ORM\OneToMany(targetEntity: Cancion::class, mappedBy: 'genero')]
    private Collection $canciones;

    public function __construct()
    {
        $this->canciones = new ArrayCollection();
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

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil): static
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * @return Collection<int, Cancion>
     */
    public function getCanciones(): Collection
    {
        return $this->canciones;
    }

    public function addCancione(Cancion $cancione): static
    {
        if (!$this->canciones->contains($cancione)) {
            $this->canciones->add($cancione);
            $cancione->setGenero($this);
        }

        return $this;
    }

    public function removeCancione(Cancion $cancione): static
    {
        if ($this->canciones->removeElement($cancione)) {
            // set the owning side to null (unless already changed)
            if ($cancione->getGenero() === $this) {
                $cancione->setGenero(null);
            }
        }

        return $this;
    }
}
