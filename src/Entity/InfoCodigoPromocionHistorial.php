<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfoCodigoPromocionHistorial
 *
 * 
 * @ORM\Table(name="INFO_CODIGO_PROMOCION_HISTORIAL")
 * @ORM\Entity(repositoryClass="App\Repository\InfoCodigoPromocionHistorialRepository")
 * 
 */
class InfoCodigoPromocionHistorial
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CODIGO_PROMOCION_HISTORIAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @var InfoCodigoPromocion
    *
    * @ORM\ManyToOne(targetEntity="InfoCodigoPromocion")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="CODIGO_PROMOCION_ID", referencedColumnName="ID_CODIGO_PROMOCION")
    * })
    */
    private $CODIGO_PROMOCION_ID;

    /**
    * @var InfoCliente
    *
    * @ORM\ManyToOne(targetEntity="InfoCliente")
    * @ORM\JoinColumns({
    * @ORM\JoinColumn(name="CLIENTE_ID", referencedColumnName="ID_CLIENTE")
    * })
    */
    private $CLIENTE_ID;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=100)
     */
    private $ESTADO;

    /**
     * @var string
     *
     * @ORM\Column(name="USR_CREACION", type="string", length=255)
     */
    private $USR_CREACION;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FE_CREACION", type="date")
     */
    private $FE_CREACION;

    /**
     * @var string
     *
     * @ORM\Column(name="USR_MODIFICACION", type="string", length=255, nullable=true)
     */
    private $USR_MODIFICACION;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FE_MODIFICACION", type="date", nullable=true)
     */
    private $FE_MODIFICACION;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set CODIGO_PROMOCION_ID
     *
     * @param \App\Entity\InfoCodigoPromocion $CODIGO_PROMOCION_ID
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setCODIGO_PROMOCION_ID(\App\Entity\InfoCodigoPromocion $CODIGO_PROMOCION_ID = null)
    {
        $this->CODIGO_PROMOCION_ID = $CODIGO_PROMOCION_ID;

        return $this;
    }

    /**
     * Get CODIGO_PROMOCION_ID
     *
     * @return \App\Entity\InfoCodigoPromocion
     */
    public function getCODIGO_PROMOCION_ID()
    {
        return $this->CODIGO_PROMOCION_ID;
    }

    /**
     * Set CLIENTE_ID
     *
     * @param \App\Entity\InfoCliente $CLIENTE_ID
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setCLIENTEID(\App\Entity\InfoCliente $CLIENTE_ID = null)
    {
        $this->CLIENTE_ID = $CLIENTE_ID;

        return $this;
    }

    /**
     * Get CLIENTE_ID
     *
     * @return \App\Entity\InfoCliente
     */
    public function getCLIENTEID()
    {
        return $this->CLIENTE_ID;
    }

    /**
     * Set ESTADO
     *
     * @param string $ESTADO
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setESTADO($ESTADO)
    {
        $this->ESTADO = $ESTADO;

        return $this;
    }

    /**
     * Get ESTADO
     *
     * @return string
     */
    public function getESTADO()
    {
        return $this->ESTADO;
    }

    /**
     * Set USR_CREACION
     *
     * @param string $USR_CREACION
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setUSRCREACION($USR_CREACION)
    {
        $this->USR_CREACION = $USR_CREACION;

        return $this;
    }

    /**
     * Get USR_CREACION
     *
     * @return string
     */
    public function getUSRCREACION()
    {
        return $this->USR_CREACION;
    }

    /**
     * Set FE_CREACION
     *
     * @param \DateTime $FE_CREACION
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setFECREACION($FE_CREACION)
    {
        $this->FE_CREACION = $FE_CREACION;

        return $this;
    }

    /**
     * Get FE_CREACION
     *
     * @return \DateTime
     */
    public function getFECREACION()
    {
        return $this->FE_CREACION;
    }

    /**
     * Set USR_MODIFICACION
     *
     * @param string $USR_MODIFICACION
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setUSRMODIFICACION($USR_MODIFICACION)
    {
        $this->USR_MODIFICACION = $USR_MODIFICACION;

        return $this;
    }

    /**
     * Get USR_MODIFICACION
     *
     * @return string
     */
    public function getUSRMODIFICACION()
    {
        return $this->USR_MODIFICACION;
    }

    /**
     * Set FE_MODIFICACION
     *
     * @param \DateTime $FE_MODIFICACION
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setFEMODIFICACION($FE_MODIFICACION)
    {
        $this->FE_MODIFICACION = $FE_MODIFICACION;

        return $this;
    }

    /**
     * Get FE_MODIFICACION
     *
     * @return \DateTime
     */
    public function getFEMODIFICACION()
    {
        return $this->FE_MODIFICACION;
    }

}
