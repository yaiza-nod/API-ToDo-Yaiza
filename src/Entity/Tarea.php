<?php

namespace App\Entity;

use App\Repository\TareaRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TareaRepository::class)
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="tarea:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="tarea:item"}}},
 *     order={"fecha"="DESC"},
 *     paginationEnabled=false
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={"user": "exact"})
 */
class Tarea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"tarea:list", "tarea:item"})
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"tarea:list", "tarea:item"})
     */
    private $marcada;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"tarea:list", "tarea:item"})
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tarea:list", "tarea:item"})
     */
    private $titulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"tarea:list", "tarea:item"})
     */
    private $descripcion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"tarea:list", "tarea:item"})
     */
    private $creacion;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"tarea:list", "tarea:item"})
     */
    private $categoria;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tareas")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"tarea:list", "tarea:item"})
     */
    private $idUsuario;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = strip_tags($descripcion);

        return $this;
    }

    public function getCreacion(): ?\DateTimeInterface
    {
        return $this->creacion;
    }

    public function setCreacion(\DateTimeInterface $creacion): self
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

    public function getIdUsuario(): ?User
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?User $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }
}
