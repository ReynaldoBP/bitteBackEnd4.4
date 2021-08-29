<?php

namespace App\Repository;

use App\Entity\AdmiTipoCupon;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method AdmiTipoCupon|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmiTipoCupon|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmiTipoCupon[]    findAll()
 * @method AdmiTipoCupon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmiTipoCuponRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getTipoCupon'.
     *
     * Método encargado de retornar todos los tipos de cupones según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 27-08-2021
     * 
     * @return array  $arrayResultado
     * 
     */
    public function getTipoCupon($arrayParametros)
    {
        $arrayResultado  = array();
        $objRsmBuilder   = new ResultSetMappingBuilder($this->_em);
        $objQuery        = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $strEstadoActivo = 'ACTIVO';
        $strMensajeError = '';
        $strSelect       = '';
        $strFrom         = '';
        $strWhere        = '';
        $strOrderBy      = '';
        try
        {
            $strSelect  = " SELECT ATC.ID_TIPO_CUPON, CONCAT(UPPER(LEFT(REPLACE(ATC.DESCRIPCION,'_',' '), 1)), LOWER(SUBSTRING(REPLACE(ATC.DESCRIPCION,'_',' '), 2))) AS DESCRIPCION ";
            $strFrom    = " FROM ADMI_TIPO_CUPON ATC ";
            $strWhere   = " WHERE ATC.ESTADO = :strEstadoActivo ";
            $strOrderBy = " ORDER BY ATC.DESCRIPCION ASC ";
            $objQuery->setParameter("strEstadoActivo", $strEstadoActivo);
            $objRsmBuilder->addScalarResult('ID_TIPO_CUPON' , 'ID_TIPO_CUPON' , 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION'   , 'DESCRIPCION'   , 'string');
            $strSql  = $strSelect.$strFrom.$strWhere.$strOrderBy;
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
