<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;



    #[ORM\OneToOne(targetEntity: Usuario::class, inversedBy: 'perfil')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Usuario $usuario;

    /**
     * @var Collection<int, PerfilEstilo>
     */
    #[ORM\OneToMany(targetEntity: PerfilEstilo::class, mappedBy: 'perfil')]
    private Collection $estilosPreferidos;

    public function __construct()
    {
            $this->estilosPreferidos = new ArrayCollection();
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

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): static
    {
        $this->foto = $foto;

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
   

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        // unset the owning side of the relation if necessary
        if ($usuario === null && $this->usuario !== null) {
            $this->usuario->setPerfil(null);
        }

        // set the owning side of the relation if necessary
        if ($usuario !== null && $usuario->getPerfil() !== $this) {
            $usuario->setPerfil($this);
        }

        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection<int, PerfilEstilo>
     */
    public function getEstilosPreferidos(): Collection
    {
        return $this->estilosPreferidos;
    }

    public function addEstilosPreferido(PerfilEstilo $estilosPreferido): static
    {
        if (!$this->estilosPreferidos->contains($estilosPreferido)) {
            $this->estilosPreferidos->add($estilosPreferido);
            $estilosPreferido->setPerfil($this);
        }

        return $this;
    }

    public function removeEstilosPreferidos(PerfilEstilo $estilosPreferidos): static
    {
        if ($this->estilosPreferidos->removeElement($estilosPreferidos)) {
            
            if ($estilosPreferidos->getPerfil() === $this) {
                $estilosPreferidos->setPerfil(null);
            }
        }

        return $this;
    }
}
