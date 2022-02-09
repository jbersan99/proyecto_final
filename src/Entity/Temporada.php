<?php

namespace App\Entity;

use App\Repository\TemporadaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TemporadaRepository::class)
 */
class Temporada
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
    private $inicio_fecha;

    /**
     * @ORM\Column(type="date")
     */
    private $fin_fecha;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tipo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInicioFecha(): ?\DateTimeInterface
    {
        return $this->inicio_fecha;
    }

    public function setInicioFecha(\DateTimeInterface $inicio_fecha): self
    {
        $this->inicio_fecha = $inicio_fecha;

        return $this;
    }

    public function getFinFecha(): ?\DateTimeInterface
    {
        return $this->fin_fecha;
    }

    public function setFinFecha(\DateTimeInterface $fin_fecha): self
    {
        $this->fin_fecha = $fin_fecha;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
}
