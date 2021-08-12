<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
/**
 * InfoPublicidadComidaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoCodigoPromocionRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getCodigoPromocionCriterio'
     * Método encargado de retornar los codigos según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 25-08-2020
     * 
     * @return array  $arrayCodigo
     * 
     */
    public function getCodigoPromocionCriterio($arrayParametros)
    {
        $intIdPromocion     = $arrayParametros['intIdPromocion'] ? $arrayParametros['intIdPromocion']:'';
        $intIdRestaurante   = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','CANJEADO','ELIMINADO');
        $arrayCodigo   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount = new ResultSetMappingBuilder($this->_em);
        $objQueryCount      = $this->_em->createNativeQuery(null, $objRsmBuilderCount);
        try
        {
            $strSelect      = " SELECT ICP.ID_CODIGO_PROMOCION,ICP.RESTAURANTE_ID,ICP.PROMOCION_ID,ICP.CODIGO,ICP.ESTADO,
                                IRES.NOMBRE_COMERCIAL,IPR.DESCRIPCION_TIPO_PROMOCION,
                                CASE
                                    WHEN ICP.ESTADO ='ACTIVO' THEN 'SI'
                                    WHEN ICP.ESTADO ='ELIMINADO' THEN 'NO'
                                END as BANDERA_ESTADO,
                                CASE
                                    WHEN ICP.ESTADO ='CANJEADO' THEN 'SI'
                                    ELSE 'NO'
                                END as BANDERA_CANJEADO,
                                CONCAT(IC.NOMBRE,CONCAT(' ',IC.APELLIDO)) AS CLIENTE,
                                IPCH.FE_CREACION ";
            $strFrom        = " FROM INFO_CODIGO_PROMOCION ICP 
                                JOIN INFO_PROMOCION IPR ON IPR.ID_PROMOCION=ICP.PROMOCION_ID
                                JOIN INFO_RESTAURANTE IRES ON IRES.ID_RESTAURANTE=ICP.RESTAURANTE_ID 
                                LEFT JOIN INFO_CODIGO_PROMOCION_HISTORIAL IPCH ON IPCH.CODIGO_PROMOCION_ID=ICP.ID_CODIGO_PROMOCION
                                LEFT JOIN INFO_CLIENTE IC ON IC.ID_CLIENTE=IPCH.CLIENTE_ID";
            $strWhere       = " WHERE ICP.ESTADO in (:ESTADO) ";
            $strOrder       = " order by ICP.ESTADO ASC ";
            $objQuery->setParameter("ESTADO",$strEstado);
            $objQueryCount->setParameter("ESTADO",$strEstado);
            if(!empty($intIdPromocion))
            {
                $strWhere .= " AND ICP.PROMOCION_ID = :intIdPromocion ";
                $objQuery->setParameter("intIdPromocion",$intIdPromocion);
            }
            if(!empty($intIdRestaurante))
            {
                $strWhere .= " AND ICP.RESTAURANTE_ID = :intIdRestaurante ";
                $objQuery->setParameter("intIdRestaurante",$intIdRestaurante);
            }
            $objRsmBuilder->addScalarResult('ID_CODIGO_PROMOCION', 'ID_CODIGO_PROMOCION', 'string');
            $objRsmBuilder->addScalarResult('RESTAURANTE_ID', 'RESTAURANTE_ID', 'string');
            $objRsmBuilder->addScalarResult('PROMOCION_ID', 'PROMOCION_ID', 'string');
            $objRsmBuilder->addScalarResult('CODIGO', 'CODIGO', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'NOMBRE_COMERCIAL', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION_TIPO_PROMOCION', 'DESCRIPCION_TIPO_PROMOCION', 'string');
            $objRsmBuilder->addScalarResult('BANDERA_ESTADO', 'BANDERA_ESTADO', 'string');
            $objRsmBuilder->addScalarResult('BANDERA_CANJEADO', 'BANDERA_CANJEADO', 'string');
            $objRsmBuilder->addScalarResult('CLIENTE', 'CLIENTE', 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strOrder;
            $objQuery->setSQL($strSql);
            $arrayCodigo['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCodigo['error'] = $strMensajeError;
        return $arrayCodigo;
    }
}
