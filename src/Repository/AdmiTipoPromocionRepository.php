<?php

namespace App\Repository;

use App\Entity\AdmiTipoPromocion;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method AdmiTipoPromocion|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmiTipoPromocion|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmiTipoPromocion[]    findAll()
 * @method AdmiTipoPromocion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmiTipoPromocionRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getTipoPromocion'.
     *
     * Método encargado de retornar todos los tipos de promociones según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 11-11-2021
     * 
     * @return array  $arrayResultado
     * 
     */
    public function getTipoPromocion($arrayParametros)
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
            $strSelect  = " SELECT ATP.ID_TIPO_PROMOCION, CONCAT(UPPER(LEFT(REPLACE(ATP.DESCRIPCION,'_',' '), 1)), LOWER(SUBSTRING(REPLACE(ATP.DESCRIPCION,'_',' '), 2))) AS DESCRIPCION  ";
            $strFrom    = " FROM ADMI_TIPO_PROMOCION ATP ";
            $strWhere   = " WHERE ATP.ESTADO = :strEstadoActivo ";
            $strOrderBy = " ORDER BY ATP.DESCRIPCION ASC ";
            $objQuery->setParameter("strEstadoActivo", $strEstadoActivo);
            $objRsmBuilder->addScalarResult('ID_TIPO_PROMOCION' , 'ID_TIPO_PROMOCION' , 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION'       , 'DESCRIPCION'       , 'string');
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
