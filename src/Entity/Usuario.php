<?php

# Edito la entidad con la relación que añadiré en la versión 3

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreUsuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * ORM\OneToMany(targetEntity=Tarea::class, mappedBy="usuarioAsignado", orphanRemoval=true)
     */
    private $tareasAsignadas;

    public function __construct()
    {
        #$this->tareasAsignadas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreUsuario(): ?string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(string $nombreUsuario): self
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * return Collection|Tarea[]
     */
    /*public function getTareasAsignadas(): Collection
    {
        return $this->tareasAsignadas;
    }

    public function addTareasAsignada(Tarea $tareasAsignada): self
    {
        if (!$this->tareasAsignadas->contains($tareasAsignada)) {
            $this->tareasAsignadas[] = $tareasAsignada;
            $tareasAsignada->setUsuarioAsignado($this);
        }

        return $this;
    }

    public function removeTareasAsignada(Tarea $tareasAsignada): self
    {
        if ($this->tareasAsignadas->removeElement($tareasAsignada)) {
            // set the owning side to null (unless already changed)
            if ($tareasAsignada->getUsuarioAsignado() === $this) {
                $tareasAsignada->setUsuarioAsignado(null);
            }
        }

        return $this;
    }*/
}
