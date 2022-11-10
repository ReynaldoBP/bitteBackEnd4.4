<?php

namespace App\Entity;

use App\Repository\AdmiCentroComercialRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * InfoCupon
 * 
 * @ORM\Table(name="ADMI_CENTRO_COMERCIAL")
 * @ORM\Entity(repositoryClass=AdmiCentroComercialRepository::class)
 */
class AdmiCentroComercial
{
    /**
     * @ORM\Column(name="ID_CENTRO_COMERCIAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NOMBRE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DIRECCION;

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

    public function getNOMBRE(): ?string
    {
        return $this->NOMBRE;
    }

    public function setNOMBRE(string $NOMBRE): self
    {
        $this->NOMBRE = $NOMBRE;

        return $this;
    }

    public function getDIRECCION(): ?string
    {
        return $this->DIRECCION;
    }

    public function setDIRECCION(?string $DIRECCION): self
    {
        $this->DIRECCION = $DIRECCION;

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
