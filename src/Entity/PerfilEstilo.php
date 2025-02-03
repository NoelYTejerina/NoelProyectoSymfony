<?php

namespace App\Entity;

use App\Repository\PerfilEstiloRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilEstiloRepository::class)]
class PerfilEstilo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Perfil::class, inversedBy: 'estilosPreferidos')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Perfil $perfil;

    #[ORM\ManyToOne(targetEntity: Estilo::class, inversedBy: 'perfilesSeguidores')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Estilo $estilo;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEstilo(): ?Estilo
    {
        return $this->estilo;
    }

    public function setEstilo(?Estilo $estilo): static
    {
        $this->estilo = $estilo;
        return $this;
    }
}