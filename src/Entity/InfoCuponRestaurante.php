<?php

namespace App\Entity;

use App\Repository\InfoCuponRestauranteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * InfoCuponRestaurante
 * 
 * @ORM\Table(name="INFO_CUPON_RESTAURANTE")
 * @ORM\Entity(repositoryClass=InfoCuponRestauranteRepository::class)
 */
class InfoCuponRestaurante
{
    /**
     * @ORM\Column(name="ID_RELACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @var InfoCupon
    *
    * @ORM\ManyToOne(targetEntity="InfoCupon")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="CUPON_ID", referencedColumnName="ID_CUPON")
    * })
    */
    private $CUPON_ID;

    /**
    * @var InfoRestaurante
    *
    * @ORM\ManyToOne(targetEntity="InfoRestaurante")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="RESTAURANTE_ID", referencedColumnName="ID_RESTAURANTE")
    * })
    */
    private $RESTAURANTE_ID;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ESTADO;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $USR_CREACION;

    /**
     * @ORM\Column(type="date")
     */
    private $FE_CREACION;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCUPONID(): ?InfoCupon
    {
        return $this->CUPON_ID;
    }

    public function setCUPONID(?InfoCupon $CUPON_ID): self
    {
        $this->CUPON_ID = $CUPON_ID;

        return $this;
    }

    public function getRESTAURANTEID(): ?InfoRestaurante
    {
        return $this->RESTAURANTE_ID;
    }

    public function setRESTAURANTEID(?InfoRestaurante $RESTAURANTE_ID): self
    {
        $this->RESTAURANTE_ID = $RESTAURANTE_ID;

        return $this;
    }


    public function getESTADO(): ?string
    {
        return $this->ESTADO;
    }

    public function setESTADO(string $ESTADO): self
    {
        $this->ESTADO = $ESTADO;

        return $this;
    }

    public function getUSRCREACION(): ?string
    {
        return $this->USR_CREACION;
    }

    public function setUSRCREACION(string $USR_CREACION): self
    {
        $this->USR_CREACION = $USR_CREACION;

        return $this;
    }

    public function getFECREACION(): ?\DateTimeInterface
    {
        return $this->FE_CREACION;
    }

    public function setFECREACION(\DateTimeInterface $FE_CREACION): self
    {
        $this->FE_CREACION = $FE_CREACION;

        return $this;
    }
}
