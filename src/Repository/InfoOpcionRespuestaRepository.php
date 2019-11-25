<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
/**
 * InfoOpcionRespuestaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoOpcionRespuestaRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getOpcionRespuesta'.
     *
     * Método encargado de retornar todos las opciones de respuesta según los parametros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 16-07-2019
     * 
     * @return array  $arrayOpcionRespuesta
     * 
     */
    public function getOpcionRespuesta($arrayParametros)
    {
        $strEstado            = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $intIdOpcionRespuesta = $arrayParametros['intIdOpcionRespuesta'] ? $arrayParametros['intIdOpcionRespuesta']:'';
        $arrayOpcionRespuesta = array();
        $objRsmBuilder        = new ResultSetMappingBuilder($this->_em);
        $objQuery             = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $strMensajeError      = '';
        $strSelect            = '';
        $strFrom              = '';
        $strWhere             = '';
        $strOrder             = 'ORDER BY IOR.FE_CREACION ASC';
        try
        {
            $strSelect = "SELECT IOR.ID_OPCION_RESPUESTA,IOR.TIPO_RESPUESTA,
                          IOR.DESCRIPCION,IOR.VALOR,IOR.ESTADO,IOR.USR_CREACION,IOR.FE_CREACION,
                          IOR.USR_MODIFICACION,IOR.FE_MODIFICACION ";
            $strFrom   = "FROM INFO_OPCION_RESPUESTA IOR ";
            $strWhere  = "WHERE IOR.ESTADO in (:ESTADO) ";
            $objQuery->setParameter("ESTADO", $strEstado);
            if(!empty($intIdOpcionRespuesta))
            {
                $strWhere  .= "AND IOR.ID_OPCION_RESPUESTA in (:ID_OPCION_RESPUESTA) ";
                $objQuery->setParameter("ID_OPCION_RESPUESTA", $intIdOpcionRespuesta);
            }
            $objRsmBuilder->addScalarResult('ID_OPCION_RESPUESTA', 'ID_OPCION_RESPUESTA', 'string');
            $objRsmBuilder->addScalarResult('TIPO_RESPUESTA', 'TIPO_RESPUESTA', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION', 'DESCRIPCION', 'string');
            $objRsmBuilder->addScalarResult('VALOR', 'VALOR', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $objRsmBuilder->addScalarResult('USR_CREACION', 'USR_CREACION', 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'date');
            $objRsmBuilder->addScalarResult('USR_MODIFICACION', 'USR_MODIFICACION', 'string');
            $objRsmBuilder->addScalarResult('FE_MODIFICACION', 'FE_MODIFICACION', 'date');

            $strSql  = $strSelect.$strFrom.$strWhere.$strOrder;
            $objQuery->setSQL($strSql);
            $arrayOpcionRespuesta['opcionRespuesta'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayOpcionRespuesta['error'] = $strMensajeError;
        return $arrayOpcionRespuesta;
    }
}
