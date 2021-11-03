<?php

# Edito la entidad con la relación que añadiré en la versión 3

namespace App\Entity;

use App\Repository\TareaRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TareaRepository::class)
 * @ApiResource()
 * [ApiFilter(BooleanFilter::class, properties: ['marcada'])]
 * [ApiFilter(SearchFilter::class, properties: ['categoria' => 'exact'])]
 */
class Tarea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $marcada;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creacion;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $categoria;

    /**
     * ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="tareasAsignadas")
     * ORM\JoinColumn(nullable=false)
     */
    # private $usuarioAsignado;

    public function __construct() {

        $this->setCreacion(new \DateTime('now'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarcada(): ?bool
    {
        return $this->marcada;
    }

    public function setMarcada(bool $marcada): self
    {
        $this->marcada = $marcada;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /*public function getUsuarioAsignado(): ?Usuario
    {
        return $this->usuarioAsignado;
    }

    public function setUsuarioAsignado(?Usuario $usuarioAsignado): self
    {
        $this->usuarioAsignado = $usuarioAsignado;

        return $this;
    }*/

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCreacion(): ?\DateTimeInterface
    {
        return $this->creacion;
    }

    private function setCreacion(\DateTimeInterface $creacion): self
    {
        $this->creacion = $creacion;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(?string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
}
