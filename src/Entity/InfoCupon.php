<?php

namespace App\Entity;

use App\Repository\InfoCuponRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * InfoCupon
 * 
 * @ORM\Table(name="INFO_CUPON")
 * @ORM\Entity(repositoryClass=InfoCuponRepository::class)
 */
class InfoCupon
{
    /**
     * @ORM\Column(name="ID_CUPON", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @var AdmiTipoCupon
    *
    * @ORM\ManyToOne(targetEntity="AdmiTipoCupon")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="TIPO_CUPON_ID", referencedColumnName="ID_TIPO_CUPON")
    * })
    */
    private $TIPOCUPONID;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $CUPON;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $VALOR;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $PRECIO;

    /**
     * @ORM\Column(type="string", length=450)
     */
    private $IMAGEN;

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

    /**
     * @ORM\Column(type="string", length=225, nullable=true)
     */
    private $USR_MODIFICACION;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $FE_MODIFICACION;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set TIPOCUPONID
     *
     * @param \App\Entity\AdmiTipoCupon $TIPOCUPONID
     *
     * @return InfoCupon
     */
    public function setTIPOCUPONID(\App\Entity\AdmiTipoCupon $TIPOCUPONID = null)
    {
        $this->TIPOCUPONID = $TIPOCUPONID;

        return $this;
    }

    /**
     * Get TIPOCUPONID
     *
     * @return \App\Entity\AdmiTipoCupon
     */
    public function getTIPOCUPONID()
    {
        return $this->TIPOCUPONID;
    }

    public function getCUPON(): ?string
    {
        return $this->CUPON;
    }

    public function setCUPON(string $CUPON): self
    {
        $this->CUPON = $CUPON;

        return $this;
    }

    public function setVALOR(int $VALOR): self
    {
        $this->VALOR = $VALOR;

        return $this;
    }

    public function getVALOR(): ?int
    {
        return $this->VALOR;
    }

    public function setPRECIO(int $PRECIO): self
    {
        $this->PRECIO = $PRECIO;

        return $this;
    }

    public function getPRECIO(): ?int
    {
        return $this->PRECIO;
    }

    public function getIMAGEN(): ?string
    {
        return $this->IMAGEN;
    }

    public function setIMAGEN(string $IMAGEN): self
    {
        $this->IMAGEN = $IMAGEN;

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

    public function getUSRMODIFICACION(): ?string
    {
        return $this->USR_MODIFICACION;
    }

    public function setUSRMODIFICACION(?string $USR_MODIFICACION): self
    {
        $this->USR_MODIFICACION = $USR_MODIFICACION;

        return $this;
    }

    public function getFEMODIFICACION(): ?\DateTimeInterface
    {
        return $this->FE_MODIFICACION;
    }

    public function setFEMODIFICACION(?\DateTimeInterface $FE_MODIFICACION): self
    {
        $this->FE_MODIFICACION = $FE_MODIFICACION;

        return $this;
    }
}
