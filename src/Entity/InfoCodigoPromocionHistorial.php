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
     * Set USRCREACION
     *
     * @param string $USRCREACION
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setUSRCREACION($USRCREACION)
    {
        $this->USRCREACION = $USRCREACION;

        return $this;
    }

    /**
     * Get USRCREACION
     *
     * @return string
     */
    public function getUSRCREACION()
    {
        return $this->USRCREACION;
    }

    /**
     * Set FECREACION
     *
     * @param \DateTime $FECREACION
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setFECREACION($FECREACION)
    {
        $this->FECREACION = $FECREACION;

        return $this;
    }

    /**
     * Get FECREACION
     *
     * @return \DateTime
     */
    public function getFECREACION()
    {
        return $this->FECREACION;
    }

    /**
     * Set USRMODIFICACION
     *
     * @param string $USRMODIFICACION
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setUSRMODIFICACION($USRMODIFICACION)
    {
        $this->USRMODIFICACION = $USRMODIFICACION;

        return $this;
    }

    /**
     * Get USRMODIFICACION
     *
     * @return string
     */
    public function getUSRMODIFICACION()
    {
        return $this->USRMODIFICACION;
    }

    /**
     * Set FEMODIFICACION
     *
     * @param \DateTime $FEMODIFICACION
     *
     * @return InfoCodigoPromocionHistorial
     */
    public function setFEMODIFICACION($FEMODIFICACION)
    {
        $this->FEMODIFICACION = $FEMODIFICACION;

        return $this;
    }

    /**
     * Get FEMODIFICACION
     *
     * @return \DateTime
     */
    public function getFEMODIFICACION()
    {
        return $this->FEMODIFICACION;
    }

}
