<?php

namespace App\Entity;

use App\Repository\InfoCuponPromocionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * InfoCuponPromocion
 *
 * @ORM\Table(name="INFO_CUPON_PROMOCION")
 * @ORM\Entity(repositoryClass=InfoCuponPromocionRepository::class)
 */
class InfoCuponPromocion
{
    /**
     * 
     * @ORM\Column(name="ID_CUPON_PROMOCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @var InfoPromocion
    *
    * @ORM\ManyToOne(targetEntity="InfoPromocion")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="PROMOCION_ID", referencedColumnName="ID_PROMOCION")
    * })
    */
    private $PROMOCION_ID;

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
     * @ORM\Column(type="string", length=100)
     */
    private $ESTADO;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $USR_CREACION;

    /**
     * @ORM\Column(type="datetime")
     */
    private $FE_CREACION;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPROMOCIONID(): ?InfoPromocion
    {
        return $this->PROMOCION_ID;
    }

    public function setPROMOCIONID(?InfoPromocion $PROMOCION_ID): self
    {
        $this->PROMOCION_ID = $PROMOCION_ID;

        return $this;
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
