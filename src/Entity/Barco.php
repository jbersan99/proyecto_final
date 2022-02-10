<?php

namespace App\Entity;

use App\Repository\BarcoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=BarcoRepository::class)
 * @ApiResource()
 */
class Barco
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $matricula;

    /**
     * @ORM\Column(type="integer")
     */
    private $pasajeros_maximos;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio_con_patron;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio_sin_patron;

    /**
     * @ORM\Column(type="integer")
     */
    private $eslora;

    /**
     * @ORM\Column(type="integer")
     */
    private $calado;

    /**
     * @ORM\Column(type="integer")
     */
    private $caballos;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $licencia;

    /**
     * @ORM\Column(type="integer")
     */
    private $latitud;

    /**
     * @ORM\Column(type="integer")
     */
    private $longitud;

    /**
     * @ORM\Column(type="boolean")
     */
    private $patron;

    /**
     * @ORM\OneToMany(targetEntity=Reserva::class, mappedBy="barco_reserva")
     */
    private $reservas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagenes;

    /**
     * @ORM\Column(type="integer")
     */
    private $cubierta;


    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getPasajerosMaximos(): ?int
    {
        return $this->pasajeros_maximos;
    }

    public function setPasajerosMaximos(int $pasajeros_maximos): self
    {
        $this->pasajeros_maximos = $pasajeros_maximos;

        return $this;
    }

    public function getPrecioConPatron(): ?int
    {
        return $this->precio_con_patron;
    }

    public function setPrecioConPatron(int $precio_con_patron): self
    {
        $this->precio_con_patron = $precio_con_patron;

        return $this;
    }

    public function getPrecioSinPatron(): ?int
    {
        return $this->precio_sin_patron;
    }

    public function setPrecioSinPatron(int $precio_sin_patron): self
    {
        $this->precio_sin_patron = $precio_sin_patron;

        return $this;
    }

    public function getEslora(): ?int
    {
        return $this->eslora;
    }

    public function setEslora(int $eslora): self
    {
        $this->eslora = $eslora;

        return $this;
    }

    public function getCalado(): ?int
    {
        return $this->calado;
    }

    public function setCalado(int $calado): self
    {
        $this->calado = $calado;

        return $this;
    }

    public function getCaballos(): ?int
    {
        return $this->caballos;
    }

    public function setCaballos(int $caballos): self
    {
        $this->caballos = $caballos;

        return $this;
    }

    public function getLicencia(): ?string
    {
        return $this->licencia;
    }

    public function setLicencia(string $licencia): self
    {
        $this->licencia = $licencia;

        return $this;
    }

    public function getLatitud(): ?int
    {
        return $this->latitud;
    }

    public function setLatitud(int $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function getLongitud(): ?int
    {
        return $this->longitud;
    }

    public function setLongitud(int $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    public function getPatron(): ?bool
    {
        return $this->patron;
    }

    public function setPatron(bool $patron): self
    {
        $this->patron = $patron;

        return $this;
    }


    /**
     * @return Collection|Reserva[]
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas[] = $reserva;
            $reserva->setBarcoReserva($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getBarcoReserva() === $this) {
                $reserva->setBarcoReserva(null);
            }
        }

        return $this;
    }

    public function getImagenes(): ?string
    {
        return $this->imagenes;
    }

    public function setImagenes(string $imagenes): self
    {
        $this->imagenes = $imagenes;

        return $this;
    }

    public function getCubierta(): ?int
    {
        return $this->cubierta;
    }

    public function setCubierta(int $cubierta): self
    {
        $this->cubierta = $cubierta;

        return $this;
    }

}
