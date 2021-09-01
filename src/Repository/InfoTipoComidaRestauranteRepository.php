<?php

namespace App\Repository;

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
class InfoTipoComidaRestauranteRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getRelacionComidaResCriterio'
     * Función encargado de retornar las relaciones entre tipo de comida y restaurante, según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 31-08-2021
     * 
     * @return array  $arrayResultado
     * 
     */
    public function getRelacionComidaResCriterio($arrayParametros)
    {
        $intIdRestaurante   = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $intIdTipoComida    = $arrayParametros['intIdTipoComida']  ? $arrayParametros['intIdTipoComida']:'';
        $strEstadoActivo    = "ACTIVO";
        $arrayResultado     = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT IRE.ID_RESTAURANTE,IRE.NOMBRE_COMERCIAL,ATC.ID_TIPO_COMIDA, ATC.DESCRIPCION_TIPO_COMIDA ";
            $strFrom        = "FROM INFO_TIPO_COMIDA_RESTAURANTE ITCR
                               JOIN INFO_RESTAURANTE IRE ON IRE.ID_RESTAURANTE = ITCR.RESTAURANTE_ID
                               JOIN ADMI_TIPO_COMIDA ATC ON ATC.ID_TIPO_COMIDA = ITCR.TIPO_COMIDA_ID ";
            $strWhere       = "WHERE ITCR.ESTADO = :strEstadoActivo ";
            $objQuery->setParameter("strEstadoActivo",$strEstadoActivo);
            if(!empty($intIdRestaurante))
            {
                $strWhere .= " AND ITCR.RESTAURANTE_ID =:intIdRestaurante ";
                $objQuery->setParameter("intIdRestaurante", $intIdRestaurante);
            }
            if(!empty($intIdTipoComida))
            {
                $strWhere .= " AND ITCR.TIPO_COMIDA_ID =:intIdTipoComida ";
                $objQuery->setParameter("intIdTipoComida", $intIdTipoComida);
            }

            $objRsmBuilder->addScalarResult('ID_RESTAURANTE'         , 'ID_RESTAURANTE'         , 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL'       , 'NOMBRE_COMERCIAL'       , 'string');
            $objRsmBuilder->addScalarResult('ID_TIPO_COMIDA'         , 'ID_TIPO_COMIDA'         , 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION_TIPO_COMIDA', 'DESCRIPCION_TIPO_COMIDA', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arrayResultado['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayResultado['error'] = $strMensajeError;
        return $arrayResultado;
    }
}
