<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method AdmiCentroComercial|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmiCentroComercial|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmiCentroComercial[]    findAll()
 * @method AdmiCentroComercial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmiCentroComercialRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getCentroComercial'.
     *
     * Método encargado de retornar todos los detalles de los centros comerciales según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 11-11-2022
     * 
     * @return array  $arrayResultado
     * 
     */
    public function getCentroComercial($arrayParametros)
    {
        $intIdCC             = $arrayParametros['intIdCC']   ? $arrayParametros['intIdCC']:'';
        $strNombre           = $arrayParametros['strNombre'] ? $arrayParametros['strNombre']:'';
        $arrayResultado      = array();
        $objRsmBuilder       = new ResultSetMappingBuilder($this->_em);
        $objQuery            = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $strMensajeError     = '';
        $strSelect           = '';
        $strFrom             = '';
        $strWhere            = '';
        $strOrderBy          = '';
        try
        {
            $strSelect  = " SELECT ID_CENTRO_COMERCIAL,NOMBRE,DIRECCION,
                            ESTADO, USR_CREACION,FE_CREACION ";
            $strFrom    = " FROM ADMI_CENTRO_COMERCIAL ACC ";
            $strOrderBy = " ORDER BY ACC.FE_CREACION DESC ";
            if(!empty($intIdCC))
            {
                $strWhere .= " WHERE ACC.ID_CENTRO_COMERCIAL = :intIdCC ";
                $objQuery->setParameter("intIdCC", $intIdCC);
            }
            if(!empty($strNombre))
            {
                $strWhere .= " AND lower(ACC.NOMBRE) like lower(:strNombre) ";
                $objQuery->setParameter("strNombre", '%' . trim($strNombre) . '%');
            }
            $objRsmBuilder->addScalarResult('ID_CENTRO_COMERCIAL' , 'intIdCC'        , 'integer');
            $objRsmBuilder->addScalarResult('NOMBRE'              , 'strNombre'      , 'string');
            $objRsmBuilder->addScalarResult('DIRECCION'           , 'strDireccion'   , 'string');
            $objRsmBuilder->addScalarResult('ESTADO'              , 'strEstado'      , 'string');
            $objRsmBuilder->addScalarResult('USR_CREACION'        , 'strUsrCreacion' , 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION'         , 'strFeCreacion'  , 'string');
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
