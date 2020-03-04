<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * InfoPromocionHistorialRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoPromocionHistorialRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getPromoHistorialCriterio'
     * Método encargado de retornar todos las promociones según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 29-09-2019
     * 
     * @return array  $arrayPromocion
     * 
     */
    public function getPromoHistorialCriterio($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('PENDIENTE');
        $intIdCliente       = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $arrayPromocion     = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilder2     = new ResultSetMappingBuilder($this->_em);
        $objQuery2          = $this->_em->createNativeQuery(null, $objRsmBuilder2);
        try
        {
            $strSelect      = "SELECT sum(IPROMO.CANTIDAD_PUNTOS) as CANTIDAD_PUNTOS ";
            $strFrom        = "FROM INFO_CLIENTE_PROMOCION_HISTORIAL ICPH
                                JOIN INFO_PROMOCION IPROMO
                                    ON IPROMO.ID_PROMOCION=ICPH.PROMOCION_ID ";
            $strWhere       = "WHERE ICPH.ESTADO in (:ESTADO) AND IPROMO.PREMIO = 'NO' ";
            $objQuery->setParameter("ESTADO",$strEstado);
            $objQuery2->setParameter("ESTADO",$strEstado);
            if(!empty($intIdCliente))
            {
                $strWhere .= " AND ICPH.CLIENTE_ID =:CLIENTE_ID";
                $objQuery->setParameter("CLIENTE_ID", $intIdCliente);
                $objQuery2->setParameter("CLIENTE_ID", $intIdCliente);
            }
            $objRsmBuilder->addScalarResult('CANTIDAD_PUNTOS', 'CANTIDAD_PUNTOS', 'integer');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arrayPromocion['resultados'] = $objQuery->getSingleScalarResult();

            $strSelect2      = "SELECT DISTINCT(IRE.NOMBRE_COMERCIAL)AS NOMBRE ";
            $strFrom2        = "FROM INFO_CLIENTE_PROMOCION_HISTORIAL ICPH
                               INNER JOIN INFO_PROMOCION IPROMO
                               ON IPROMO.ID_PROMOCION=ICPH.PROMOCION_ID 
                               INNER JOIN INFO_RESTAURANTE IRE ON IRE.ID_RESTAURANTE=IPROMO.RESTAURANTE_ID ";
            
            $objRsmBuilder2->addScalarResult('NOMBRE', 'nombre', 'string');
            $strSql2       = $strSelect2.$strFrom2.$strWhere;
            $objQuery2->setSQL($strSql2);
            $arrayResultado = $objQuery2->getResult();
            $stringRestaurante = "";

            foreach ($arrayResultado as $item)
            {
               $stringRestaurante = $stringRestaurante . $item["nombre"] . ", ";
            }
            $arrayPromocion['resultados2'] = $stringRestaurante;
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayPromocion['error'] = $strMensajeError;
        return $arrayPromocion;
    }

     /**
     * Documentación para la función 'getPromoHistorialTenedorMovil'
     * Método encargado de retornar todos las promociones según los parámetros recibidos.
     * 
     * @author El Kevin de Mucho Lote
     * @version 1.0 28-02-2020
     * 
     * @return array  $arrayPromocion
     * 
     */
    public function getPromoHistorialTenedorMovil($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('PENDIENTE');
        $intIdCliente       = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $arrayPromocion     = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT 
                                       ipo.ID_PROMOCION,
                                       ipo.DESCRIPCION_TIPO_PROMOCION,
                                       ipo.IMAGEN,
                                       ipo.CANTIDAD_PUNTOS,
                                       ipo.ESTADO,
                                       ire.ID_RESTAURANTE,
                                       ire.NOMBRE_COMERCIAL,
                                       ire.NUMERO_CONTACTO,
                                       ire.DIRECCION_TRIBUTARIO  ";
            $strFrom        = "FROM 
                                    INFO_CLIENTE_PROMOCION_HISTORIAL icph 
                                    INNER JOIN INFO_PROMOCION ipo ON icph.PROMOCION_ID =ipo.ID_PROMOCION 
                                    INNER JOIN INFO_RESTAURANTE ire ON ipo.RESTAURANTE_ID = ire.ID_RESTAURANTE ";
            $strWhere       = "WHERE ipo.PREMIO = 'SI' AND icph.ESTADO in (:ESTADO) ";
            $objQuery->setParameter("ESTADO",$strEstado);
            if(!empty($intIdCliente))
            {
                $strWhere .= " AND icph.CLIENTE_ID =:CLIENTE_ID";
                $objQuery->setParameter("CLIENTE_ID", $intIdCliente);
            }
            $objRsmBuilder->addScalarResult('ID_PROMOCION', 'idPromocion', 'integer');
            $objRsmBuilder->addScalarResult('DESCRIPCION_TIPO_PROMOCION', 'descripcion', 'string');
            $objRsmBuilder->addScalarResult('IMAGEN', 'imagen', 'string');
            $objRsmBuilder->addScalarResult('CANTIDAD_PUNTOS', 'cantPuntos', 'integer');
            $objRsmBuilder->addScalarResult('ESTADO', 'estado', 'string');
            $objRsmBuilder->addScalarResult('ID_RESTAURANTE', 'idRestaurante', 'integer');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'nombreRestaurante', 'string');
            $objRsmBuilder->addScalarResult('DIRECCION_TRIBUTARIO', 'direccion', 'string');
            $objRsmBuilder->addScalarResult('NUMERO_CONTACTO', 'contacto', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arrayPromocion['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayPromocion['error'] = $strMensajeError;
        return $arrayPromocion;
    }
    /**
     * Documentación para la función 'getPromocionCriterioWeb'
     * Método encargado de retornar todos los historiales promociones según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 29-09-2019
     * 
     * @return array  $arrayPromocion
     * 
     */
    public function getPromocionCriterioWeb($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('PENDIENTE');
        $intIdRestaurante   = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $intIdCliente       = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $arrayPromocion     = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT ICH.ID_CLIENTE_PUNTO_HISTORIAL,ICH.ESTADO AS ESTADO_PROMOCION_HISTORIAL,ICH.CLIENTE_ID,
                                IPROMO.ID_PROMOCION,IPROMO.DESCRIPCION_TIPO_PROMOCION,IPROMO.ESTADO AS ESTADO_PROMOCION,
                                IRE.ID_RESTAURANTE,IRE.NOMBRE_COMERCIAL,IRE.ESTADO AS ESTADO_RESTAURANTE ";
            $strFrom        = "FROM INFO_CLIENTE_PROMOCION_HISTORIAL ICH
                                JOIN INFO_PROMOCION IPROMO 
                                    ON IPROMO.ID_PROMOCION = ICH.PROMOCION_ID
                                JOIN INFO_RESTAURANTE IRE
                                    ON IRE.ID_RESTAURANTE=IPROMO.RESTAURANTE_ID ";
            $strWhere       = "WHERE ICH.ESTADO in (:ESTADO) ";
            $objQuery->setParameter("ESTADO",$strEstado);
            if(!empty($intIdRestaurante))
            {
                $strWhere .= " AND IRE.ID_RESTAURANTE =:ID_RESTAURANTE ";
                $objQuery->setParameter("ID_RESTAURANTE", $intIdRestaurante);
            }
            if(!empty($intIdCliente))
            {
                $strWhere .= " AND ICH.CLIENTE_ID =:CLIENTE_ID ";
                $objQuery->setParameter("CLIENTE_ID", $intIdCliente);
            }
            $objRsmBuilder->addScalarResult('ID_CLIENTE_PUNTO_HISTORIAL', 'ID_CLIENTE_PUNTO_HISTORIAL', 'string');
            $objRsmBuilder->addScalarResult('ESTADO_PROMOCION_HISTORIAL', 'ESTADO_PROMOCION_HISTORIAL', 'string');
            $objRsmBuilder->addScalarResult('CLIENTE_ID', 'CLIENTE_ID', 'string');
            $objRsmBuilder->addScalarResult('ID_PROMOCION', 'ID_PROMOCION', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION_TIPO_PROMOCION', 'DESCRIPCION_TIPO_PROMOCION', 'string');
            $objRsmBuilder->addScalarResult('ESTADO_PROMOCION', 'ESTADO_PROMOCION', 'string');
            $objRsmBuilder->addScalarResult('ID_RESTAURANTE', 'ID_RESTAURANTE', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'NOMBRE_COMERCIAL', 'string');
            $objRsmBuilder->addScalarResult('ESTADO_RESTAURANTE', 'ESTADO_RESTAURANTE', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arrayPromocion['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayPromocion['error'] = $strMensajeError;
        return $arrayPromocion;
    }
}
