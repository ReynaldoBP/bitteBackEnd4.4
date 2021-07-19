<?php

namespace App\Repository;

use App\Entity\InfoBitacora;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method InfoBitacora|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoBitacora|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoBitacora[]    findAll()
 * @method InfoBitacora[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoBitacoraRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getBitacoraCriterio'.
     *
     * Método encargado de retornar todos las bitacora según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 14-07-2021
     * 
     * @return array  $arrayResultado
     * 
     */
    public function getBitacoraCriterio($arrayParametros)
    {
        $intIdBitacora   = $arrayParametros['intIdBitacora']  ? $arrayParametros['intIdBitacora']:'';
        $strModulo       = $arrayParametros['strModulo']      ? $arrayParametros['strModulo']:'';
        $strAccion       = $arrayParametros['strAccion'] ? $arrayParametros['strAccion']:'';
        $arrayResultado  = array();
        $objRsmBuilder   = new ResultSetMappingBuilder($this->_em);
        $objQuery        = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $strMensajeError = '';
        $strSelect       = '';
        $strFrom         = '';
        $strWhere        = '';
        $strOrderBy      = '';
        try
        {
            $strSelect  = " SELECT IBI.ID_BITACORA,
                                   IBI.ACCION,
                                   IBI.MODULO,
                                   concat(IUS.NOMBRES,concat(' ',IUS.APELLIDOS)) AS USUARIO,
                                   IUS.CORREO,
                                   IBI.FE_CREACION ";
            $strFrom    = " FROM INFO_BITACORA IBI
                                 JOIN INFO_USUARIO IUS ON IUS.ID_USUARIO=IBI.USUARIO_ID ";
            $strOrderBy = " ORDER BY IBI.FE_CREACION DESC ";
            if(!empty($intIdBitacora))
            {
                $strWhere .= " WHERE IBI.ID_BITACORA = :ID_BITACORA ";
                $objQuery->setParameter("ID_BITACORA", $intIdBitacora);
            }
            if(!empty($strAccion))
            {
                $strWhere .= " AND lower(IBI.ACCION) LIKE lower(:ACCION)";
                $objQuery->setParameter("ACCION", '%' . trim($strAccion) . '%');
            }
            if(!empty($strModulo))
            {
                $strWhere .= " AND lower(IBI.MODULO) LIKE lower(:MODULO)";
                $objQuery->setParameter("MODULO", '%' . trim($strModulo) . '%');
            }
            $objRsmBuilder->addScalarResult('ID_BITACORA', 'ID_BITACORA', 'string');
            $objRsmBuilder->addScalarResult('ACCION', 'ACCION', 'string');
            $objRsmBuilder->addScalarResult('MODULO'     , 'MODULO'     , 'string');
            $objRsmBuilder->addScalarResult('USUARIO'    , 'USUARIO'    , 'string');
            $objRsmBuilder->addScalarResult('CORREO'     , 'CORREO'     , 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'string');

            $strSql  = $strSelect.$strFrom.$strOrderBy;
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
