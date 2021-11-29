<?php

namespace App\Entity;

use App\Repository\TareaRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TareaRepository::class)
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_USER')"},
 *     collectionOperations={
        "post"={"security"="is_granted('ROLE_ADMIN')", "security_message"="Solo el administrador puede añadir tareas."}
 *     },
 *     itemOperations={
 *         "get"={"security"="is_granted('ROLE_USER') and object.owner == user", "security_message"="No eres el propietario de la tarea."},
 *         "put"={"security"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)", "security_message"="No eres el propietario de la tarea."}
 *     },
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
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $marcada;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $titulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank
     */
    private $creacion;

    /**
     * @param string $categoria Elegir una categoria.
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Assert\NotBlank
     * @ApiProperty(
     *      openapiContext={
                "type" = "string",
     *          "enum" = {"Ocio", "Trabajo"},
     *          "example" = "Ocio"
     *
     *     }
     * )
     */
    private $categoria;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tareas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUsuario;

    /**
     * @ORM\Column(type="integer")
     */
    private $vecesTransferida;

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

    public function getVecesTransferida(): ?int
    {
        return $this->vecesTransferida;
    }

    public function setVecesTransferida(int $vecesTransferida): self
    {
        $this->vecesTransferida = $vecesTransferida;

        return $this;
    }
}
