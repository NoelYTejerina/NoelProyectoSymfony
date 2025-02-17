<?php

namespace App\Entity;


use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

     /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];


    #[ORM\Column(length: 255, nullable: true , unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaNacimiento = null;


    // Relaciones entre entidades

    #[ORM\OneToOne(targetEntity: Perfil::class, mappedBy: 'usuario', cascade: ['persist', 'remove'])]
    private ?Perfil $perfil = null;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'propietario')]
    private Collection $Playlists;

    /**
     * @var Collection<int, UsuarioPlaylist>
     */
    #[ORM\OneToMany(targetEntity: UsuarioPlaylist::class, mappedBy: 'usuario')]
    private Collection $playlistsReproducidas;

    // constructor y metodos 

    public function __construct()
    {
        $this->Playlists = new ArrayCollection();
        $this->playlistsReproducidas = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }  

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil)
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->Playlists;
    }

    public function addPlaylist(Playlist $playlist)
    {
        if (!$this->Playlists->contains($playlist)) {
            $this->Playlists->add($playlist);
            $playlist->setPropietario($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist)
    {
        if ($this->Playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getPropietario() === $this) {
                $playlist->setPropietario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UsuarioPlaylist>
     */
    public function getPlaylistsReproducidas(): Collection
    {
        return $this->playlistsReproducidas;
    }

    public function addPlaylistsReproducida(UsuarioPlaylist $playlistsReproducida)
    {
        if (!$this->playlistsReproducidas->contains($playlistsReproducida)) {
            $this->playlistsReproducidas->add($playlistsReproducida);
            $playlistsReproducida->setUsuario($this);
        }

        return $this;
    }

    public function removePlaylistsReproducida(UsuarioPlaylist $playlistsReproducida)
    {
        if ($this->playlistsReproducidas->removeElement($playlistsReproducida)) {
            // set the owning side to null (unless already changed)
            if ($playlistsReproducida->getUsuario() === $this) {
                $playlistsReproducida->setUsuario(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin nombre';  
    }

        /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
