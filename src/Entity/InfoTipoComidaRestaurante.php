<?php

namespace App\Entity;

use App\Repository\InfoTipoComidaRestauranteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * InfoTipoComidaRestaurante
 * 
 * @ORM\Table(name="INFO_TIPO_COMIDA_RESTAURANTE")
 * @ORM\Entity(repositoryClass=InfoTipoComidaRestauranteRepository::class)
 */
class InfoTipoComidaRestaurante
{
    /**
     * @ORM\Column(name="ID_TIPO_COMIDA_RESTAURANTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
    * @var AdmiTipoComida
    *
    * @ORM\ManyToOne(targetEntity="AdmiTipoComida")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="TIPO_COMIDA_ID", referencedColumnName="ID_TIPO_COMIDA")
    * })
    */
    private $TIPO_COMIDA_ID;

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

    public function getRESTAURANTEID(): ?InfoRestaurante
    {
        return $this->RESTAURANTE_ID;
    }

    public function setRESTAURANTEID(?InfoRestaurante $RESTAURANTE_ID): self
    {
        $this->RESTAURANTE_ID = $RESTAURANTE_ID;

        return $this;
    }

    public function getTIPOCOMIDAID(): ?AdmiTipoComida
    {
        return $this->TIPO_COMIDA_ID;
    }

    public function setTIPOCOMIDAID(?AdmiTipoComida $TIPO_COMIDA_ID): self
    {
        $this->TIPO_COMIDA_ID = $TIPO_COMIDA_ID;

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
