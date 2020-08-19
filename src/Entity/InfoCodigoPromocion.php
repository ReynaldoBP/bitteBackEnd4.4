<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfoCodigoPromocion
 *
 *
 * @ORM\Table(name="INFO_CODIGO_PROMOCION")
 * @ORM\Entity(repositoryClass="App\Repository\InfoCodigoPromocionRepository")
 */
class InfoCodigoPromocion
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CODIGO_PROMOCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
    private $RESTAURANTEID;

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
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=100, nullable=false)
     */
    private $CODIGO;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=100, nullable=false)
     */
    private $ESTADO;

    /**
     * @var string
     *
     * @ORM\Column(name="EXCEL", type="string", length=400)
     */
    private $EXCEL;

    /**
     * @var string
     *
     * @ORM\Column(name="USR_CREACION", type="string", length=255)
     */
    private $USRCREACION;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FE_CREACION", type="date")
     */
    private $FECREACION;

    /**
     * @var string
     *
     * @ORM\Column(name="USR_MODIFICACION", type="string", length=255, nullable=true)
     */
    private $USRMODIFICACION;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FE_MODIFICACION", type="date", nullable=true)
     */
    private $FEMODIFICACION;

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
     * Set RESTAURANTEID
     *
     * @param \App\Entity\InfoRestaurante $RESTAURANTEID
     *
     * @return InfoCodigoPromocion
     */
    public function setRESTAURANTEID(\App\Entity\InfoRestaurante $RESTAURANTEID = null)
    {
        $this->RESTAURANTEID = $RESTAURANTEID;

        return $this;
    }

    /**
     * Get RESTAURANTEID
     *
     * @return \App\Entity\InfoRestaurante
     */
    public function getRESTAURANTEID()
    {
        return $this->RESTAURANTEID;
    }

    /**
     * Set PROMOCIONID
     *
     * @param \App\Entity\InfoPromocion $PROMOCIONID
     *
     * @return InfoCodigoPromocion
     */
    public function setPROMOCIONID(\App\Entity\InfoPromocion $PROMOCIONID = null)
    {
        $this->PROMOCION_ID = $PROMOCIONID;
        return $this;
    }

    /**
     * Get PROMOCIONID
     *
     * @return \App\Entity\InfoPromocion
     */
    public function getPROMOCIONID()
    {
        return $this->PROMOCION_ID;
    }

    /**
     * Set CODIGO
     *
     * @param string $CODIGO
     *
     * @return InfoCodigoPromocion
     */
    public function setCODIGO($CODIGO)
    {
        $this->CODIGO = $CODIGO;

        return $this;
    }

    /**
     * Get CODIGO
     *
     * @return string
     */
    public function getCODIGO()
    {
        return $this->CODIGO;
    }

    /**
     * Set ESTADO
     *
     * @param string $ESTADO
     *
     * @return InfoCodigoPromocion
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
     * Set EXCEL
     *
     * @param string $EXCEL
     *
     * @return InfoCodigoPromocion
     */
    public function setEXCEL($EXCEL)
    {
        $this->EXCEL = $EXCEL;

        return $this;
    }

    /**
     * Get EXCEL
     *
     * @return string
     */
    public function getEXCEL()
    {
        return $this->EXCEL;
    }

    /**
     * Set USRCREACION
     *
     * @param string $USRCREACION
     *
     * @return InfoCodigoPromocion
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
     * @return InfoCodigoPromocion
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
     * @return InfoCodigoPromocion
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
     * @return InfoCodigoPromocion
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
