<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
/**
 * InfoPromocionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoPromocionRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getPromocionCriterio'
     * Método encargado de retornar todos las promociones según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 05-09-2019
     * 
     * @return array  $arrayPromocion
     * 
     */    
    public function getPromocionCriterio($arrayParametros)
    {
        $intIdUsuario       = $arrayParametros['intIdUsuario'] ? $arrayParametros['intIdUsuario']:'';
        $intIdPromocion     = $arrayParametros['intIdPromocion'] ? $arrayParametros['intIdPromocion']:'';
        $strPromo           = $arrayParametros['strPromo'] ? $arrayParametros['strPromo']:'';
        $strMes             = $arrayParametros['strMes'] ? $arrayParametros['strMes']:'';
        $strAnio            = $arrayParametros['strAnio'] ? $arrayParametros['strAnio']:'';
        $intIdRestaurante   = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $strDescrPromocion  = $arrayParametros['strDescrPromocion'] ? $arrayParametros['strDescrPromocion']:'';
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $arrayPromocion     = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount = new ResultSetMappingBuilder($this->_em);
        $objQueryCount      = $this->_em->createNativeQuery(null, $objRsmBuilderCount);
        try
        {
            $strSelect      = "SELECT PR.ID_PROMOCION,PR.DESCRIPCION_TIPO_PROMOCION, PR.CANTIDAD_PUNTOS, PR.ACEPTA_GLOBAL,
                               PR.CODIGO,PR.ESTADO,PR.USR_CREACION,PR.FE_CREACION,PR.USR_MODIFICACION,PR.FE_MODIFICACION, 
                               PR.PREMIO,PR.IMAGEN,
                               IRE.ID_RESTAURANTE,IRE.IDENTIFICACION,IRE.RAZON_SOCIAL,IRE.NOMBRE_COMERCIAL ";
            $strSelectCount = "SELECT COUNT(*) AS CANTIDAD ";
            $strFrom        = "FROM INFO_PROMOCION PR 
                                JOIN INFO_RESTAURANTE IRE ON IRE.ID_RESTAURANTE=PR.RESTAURANTE_ID ";
            $strWhere       = "WHERE PR.ESTADO in (:ESTADO) ";
            $strOrder       = " order by PR.ESTADO ASC ";
            $objQuery->setParameter("ESTADO",$strEstado);
            $objQueryCount->setParameter("ESTADO",$strEstado);
            if(!empty($intIdPromocion))
            {
                $strWhere .= " AND PR.ID_PROMOCION =:ID_PROMOCION";
                $objQuery->setParameter("ID_PROMOCION", $intIdPromocion);
                $objQueryCount->setParameter("ID_PROMOCION", $intIdPromocion);
            }
            if(!empty($intIdUsuario))
            {
                $strFrom  .= " JOIN INFO_USUARIO_RES IUR ON IRE.ID_RESTAURANTE=IUR.RESTAURANTE_ID ";
                $strWhere .= " AND IUR.USUARIO_ID =:USUARIO_ID";
                $objQuery->setParameter("USUARIO_ID", $intIdUsuario);
                $objQueryCount->setParameter("USUARIO_ID", $intIdUsuario);
            }
            if(!empty($strPromo) && !empty($strMes) && !empty($strAnio))
            {
                $strWhere .= " AND PR.PREMIO =:PREMIO
                                AND NOT EXISTS(SELECT *
                                                FROM INFO_CLIENTE_PROMOCION_HISTORIAL A
                                                WHERE A.PROMOCION_ID = PR.ID_PROMOCION
                                                AND EXTRACT(YEAR  FROM A.FE_CREACION ) = :strAnio
                                                AND EXTRACT(MONTH FROM A.FE_CREACION ) = :strMes) ";
                $objQuery->setParameter("PREMIO", $strPromo);
                $objQuery->setParameter("strAnio", $strAnio);
                $objQuery->setParameter("strMes", $strMes);
                $objQueryCount->setParameter("PREMIO", $strPromo);
                $objQueryCount->setParameter("strAnio", $strAnio);
                $objQueryCount->setParameter("strMes", $strMes);
            }
            /*if(!empty($intIdSucursal))
            {
                $strWhere .= " AND ISUR.ID_SUCURSAL =:ID_SUCURSAL";
                $objQuery->setParameter("ID_SUCURSAL", $intIdSucursal);
                $objQueryCount->setParameter("ID_SUCURSAL", $intIdSucursal);
            }*/
            if(!empty($intIdRestaurante))
            {
                $strWhere .= " AND IRE.ID_RESTAURANTE =:ID_RESTAURANTE ";
                $objQuery->setParameter("ID_RESTAURANTE", $intIdRestaurante);
                $objQueryCount->setParameter("ID_RESTAURANTE", $intIdRestaurante);
            }
            if(!empty($strDescrPromocion))
            {
                $strWhere .= " AND lower(PR.DESCRIPCION_TIPO_PROMOCION) like lower(:DESCRIPCION_TIPO_PROMOCION)";
                $objQuery->setParameter("DESCRIPCION_TIPO_PROMOCION", '%' . trim($strDescrPromocion) . '%');
                $objQueryCount->setParameter("DESCRIPCION_TIPO_PROMOCION", '%' . trim($strDescrPromocion) . '%');
            }
            $objRsmBuilder->addScalarResult('ID_PROMOCION', 'ID_PROMOCION', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION_TIPO_PROMOCION', 'DESCRIPCION_TIPO_PROMOCION', 'string');
            $objRsmBuilder->addScalarResult('CANTIDAD_PUNTOS', 'CANTIDAD_PUNTOS', 'string');
            $objRsmBuilder->addScalarResult('ACEPTA_GLOBAL', 'ACEPTA_GLOBAL', 'string');
            $objRsmBuilder->addScalarResult('CODIGO', 'CODIGO', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $objRsmBuilder->addScalarResult('USR_CREACION', 'USR_CREACION', 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'date');
            $objRsmBuilder->addScalarResult('USR_MODIFICACION', 'USR_MODIFICACION', 'string');
            $objRsmBuilder->addScalarResult('FE_MODIFICACION', 'FE_MODIFICACION', 'date');
            $objRsmBuilder->addScalarResult('IMAGEN', 'IMAGEN', 'string');
            $objRsmBuilder->addScalarResult('PREMIO', 'PREMIO', 'string');
            $objRsmBuilder->addScalarResult('ID_RESTAURANTE', 'ID_RESTAURANTE', 'string');
            $objRsmBuilder->addScalarResult('IDENTIFICACION', 'IDENTIFICACION', 'string');
            $objRsmBuilder->addScalarResult('RAZON_SOCIAL', 'RAZON_SOCIAL', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'NOMBRE_COMERCIAL', 'string');
            $objRsmBuilderCount->addScalarResult('CANTIDAD', 'Cantidad', 'integer');
            $strSql       = $strSelect.$strFrom.$strWhere.$strOrder;
            $objQuery->setSQL($strSql);
            $strSqlCount  = $strSelectCount.$strFrom.$strWhere.$strOrder;;
            $objQueryCount->setSQL($strSqlCount);
            $arrayPromocion['cantidad']   = $objQueryCount->getSingleScalarResult();
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
