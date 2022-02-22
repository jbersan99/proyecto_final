<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ReservaRepository::class)
 * @ApiResource()
 */
class Reserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_inicio;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_fin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $precio_total;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $creacion_reserva;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valoracion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comentario;

    /**
     * @ORM\ManyToOne(targetEntity=Barco::class, inversedBy="reservas")
     * @ORM\JoinColumn(nullable=true)
     */
    private $barco_reserva;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservas_usuario")
     * @ORM\JoinColumn(nullable=true)
     */
    private $usuario_reserva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getPrecioTotal(): ?int
    {
        return $this->precio_total;
    }

    public function setPrecioTotal(int $precio_total): self
    {
        $this->precio_total = $precio_total;

        return $this;
    }

    public function getCreacionReserva(): ?\DateTimeInterface
    {
        return $this->creacion_reserva;
    }

    public function setCreacionReserva(\DateTimeInterface $creacion_reserva): self
    {
        $this->creacion_reserva = $creacion_reserva;

        return $this;
    }

    public function getValoracion(): ?int
    {
        return $this->valoracion;
    }

    public function setValoracion(int $valoracion): self
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getBarcoReserva(): ?Barco
    {
        return $this->barco_reserva;
    }

    public function setBarcoReserva(?Barco $barco_reserva): self
    {
        $this->barco_reserva = $barco_reserva;

        return $this;
    }

    public function getUsuarioReserva(): ?User
    {
        return $this->usuario_reserva;
    }

    public function setUsuarioReserva(?User $usuario_reserva): self
    {
        $this->usuario_reserva = $usuario_reserva;

        return $this;
    }

}
