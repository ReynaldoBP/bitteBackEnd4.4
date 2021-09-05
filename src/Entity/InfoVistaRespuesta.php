<?php

namespace App\Entity;

use App\Repository\InfoVistaRespuestaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * InfoVistaRespuesta
 * 
 * @ORM\Table(name="INFO_VISTA_RESPUESTA")
 * @ORM\Entity(repositoryClass=InfoVistaRespuestaRepository::class)
 */
class InfoVistaRespuesta
{
    /**
     * 
     * @ORM\Column(name="ID_VISTA_RESPUESTA", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @var InfoUsuario
    *
    * @ORM\ManyToOne(targetEntity="InfoUsuario")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="USUARIO_ID", referencedColumnName="ID_USUARIO")
    * })
    */
    private $USUARIO_ID;

    /**
    * @var InfoClienteEncuesta
    *
    * @ORM\ManyToOne(targetEntity="InfoClienteEncuesta")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="CLT_ENCUESTA_ID", referencedColumnName="ID_CLT_ENCUESTA")
    * })
    */
    private $CLT_ENCUESTA_ID;

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

    /**
     * Set USUARIOID
     *
     * @param \App\Entity\InfoUsuario $USUARIOID
     *
     * @return InfoVistaRespuesta
     */
    public function setUSUARIOID(\App\Entity\InfoUsuario $USUARIOID = null)
    {
        $this->USUARIO_ID = $USUARIOID;

        return $this;
    }

    /**
     * Get USUARIOID
     *
     * @return \App\Entity\InfoUsuario
     */
    public function getUSUARIOID()
    {
        return $this->USUARIO_ID;
    }

    /**
     * Set CLTENCUESTAID
     *
     * @param \App\Entity\InfoClienteEncuesta $CLTENCUESTAID
     *
     * @return InfoVistaRespuesta
     */
    public function setCLTENCUESTAID(\App\Entity\InfoClienteEncuesta $CLTENCUESTAID = null)
    {
        $this->CLT_ENCUESTA_ID = $CLTENCUESTAID;

        return $this;
    }

    /**
     * Get CLTENCUESTAID
     *
     * @return \App\Entity\InfoClienteEncuesta
     */
    public function getCLTENCUESTAID()
    {
        return $this->CLT_ENCUESTA_ID;
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
