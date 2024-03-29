<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
/**
 * InfoUsuarioResRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoUsuarioResRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getRelacionUsResCriterio'
     * Método encargado de retornar las relaciones entre usuario y restaurante según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 15-09-2019
     * 
     * @return array  $arrayUsuarioRes
     * 
     */
    public function getRelacionUsResCriterio($arrayParametros)
    {
        $intIdUsuarioRes    = $arrayParametros['intIdUsuarioRes'] ? $arrayParametros['intIdUsuarioRes']:'';
        $intIdRestaurante   = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $intIdUsuario       = $arrayParametros['intIdUsuario'] ? $arrayParametros['intIdUsuario']:'';
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $arrayUsuarioRes    = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount = new ResultSetMappingBuilder($this->_em);
        $objQueryCount      = $this->_em->createNativeQuery(null, $objRsmBuilderCount);
        try
        {
            $strSelect      = "SELECT IUR.ID_USUARIO_RES,IUR.SUCURSAL_ID,IUR.ESTADO,IUR.USR_CREACION,IUR.FE_CREACION,IUR.USR_MODIFICACION,IUR.FE_MODIFICACION,
                                IRE.ID_RESTAURANTE,IRE.IDENTIFICACION,IRE.RAZON_SOCIAL,IRE.NOMBRE_COMERCIAL,
                                IUS.ID_USUARIO,IUS.NOMBRES,IUS.APELLIDOS,IUS.CORREO,IUS.IDENTIFICACION AS IDENTIFICACION_US ";
            $strSelectCount = "SELECT COUNT(*) AS CANTIDAD ";
            $strFrom        = "FROM INFO_USUARIO_RES IUR
                                JOIN INFO_RESTAURANTE IRE ON IRE.ID_RESTAURANTE=IUR.RESTAURANTE_ID
                                JOIN INFO_USUARIO IUS ON IUS.ID_USUARIO=IUR.USUARIO_ID ";
            $strWhere       = "WHERE IUR.ESTADO in (:ESTADO) ";
            $objQuery->setParameter("ESTADO",$strEstado);
            $objQueryCount->setParameter("ESTADO",$strEstado);
            if(!empty($intIdUsuarioRes))
            {
                $strWhere .= " AND IUR.ID_USUARIO_RES =:ID_USUARIO_RES";
                $objQuery->setParameter("ID_USUARIO_RES", $intIdUsuarioRes);
                $objQueryCount->setParameter("ID_USUARIO_RES", $intIdUsuarioRes);
            }
            if(!empty($intIdUsuario))
            {
                $strWhere .= " AND IUS.ID_USUARIO =:ID_USUARIO";
                $objQuery->setParameter("ID_USUARIO", $intIdUsuario);
                $objQueryCount->setParameter("ID_USUARIO", $intIdUsuario);
            }
            if(!empty($intIdRestaurante))
            {
                $strWhere .= " AND IRE.ID_RESTAURANTE =:ID_RESTAURANTE";
                $objQuery->setParameter("ID_RESTAURANTE", $intIdRestaurante);
                $objQueryCount->setParameter("ID_RESTAURANTE", $intIdRestaurante);
            }

            $objRsmBuilder->addScalarResult('ID_USUARIO_RES', 'ID_USUARIO_RES', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $objRsmBuilder->addScalarResult('USR_CREACION', 'USR_CREACION', 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'date');
            $objRsmBuilder->addScalarResult('USR_MODIFICACION', 'USR_MODIFICACION', 'string');
            $objRsmBuilder->addScalarResult('FE_MODIFICACION', 'FE_MODIFICACION', 'date');
            $objRsmBuilder->addScalarResult('ID_RESTAURANTE', 'ID_RESTAURANTE', 'string');
            $objRsmBuilder->addScalarResult('SUCURSAL_ID', 'SUCURSAL_ID', 'string');
            $objRsmBuilder->addScalarResult('IDENTIFICACION', 'IDENTIFICACION', 'string');
            $objRsmBuilder->addScalarResult('RAZON_SOCIAL', 'RAZON_SOCIAL', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'NOMBRE_COMERCIAL', 'string');
            $objRsmBuilder->addScalarResult('ID_USUARIO', 'ID_USUARIO', 'string');
            $objRsmBuilder->addScalarResult('IDENTIFICACION_US', 'IDENTIFICACION_US', 'string');
            $objRsmBuilder->addScalarResult('NOMBRES', 'NOMBRES', 'string');
            $objRsmBuilder->addScalarResult('APELLIDOS', 'APELLIDOS', 'string');
            $objRsmBuilder->addScalarResult('CORREO', 'CORREO', 'string');

            $objRsmBuilderCount->addScalarResult('CANTIDAD', 'Cantidad', 'integer');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $strSqlCount  = $strSelectCount.$strFrom.$strWhere;
            $objQueryCount->setSQL($strSqlCount);
            $arrayUsuarioRes['cantidad']   = $objQueryCount->getSingleScalarResult();
            $arrayUsuarioRes['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayUsuarioRes['error'] = $strMensajeError;
        return $arrayUsuarioRes;
    }
}
