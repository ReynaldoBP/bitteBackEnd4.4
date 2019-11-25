<?php

namespace App\Repository;

use App\Entity\AdmiTipoRol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
/**
 * @method AdmiTipoRol|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmiTipoRol|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmiTipoRol[]    findAll()
 * @method AdmiTipoRol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmiTipoRolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmiTipoRol::class);
    }

    // /**
    //  * @return AdmiTipoRol[] Returns an array of AdmiTipoRol objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdmiTipoRol
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * Documentación para la función 'getTipoRol'.
     * Método encargado de retornar todos los tipo de roles según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 27-08-2019
     * 
     * @return array  $arrayTipoRol
     * 
     */
    public function getTipoRol($arrayParametros)
    {
        $strEstado       = $arrayParametros['estado'] ? $arrayParametros['estado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $strDescripcion  = $arrayParametros['descripcion'] ? $arrayParametros['descripcion']:'';
        $intIdTipoRol    = $arrayParametros['idTipoRol'] ? $arrayParametros['idTipoRol']:'';
        $arrayTipoRol    = array();
        $objRsmBuilder   = new ResultSetMappingBuilder($this->_em);
        $objQuery        = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $strMensajeError = '';
        $strSelect       = '';
        $strFrom         = '';
        $strWhere        = '';
        $strOrder        = 'ORDER BY tipoRol.DESCRIPCION_TIPO_ROL ASC';
        try
        {
            $strSelect = "SELECT tipoRol.ID_TIPO_ROL,tipoRol.DESCRIPCION_TIPO_ROL,tipoRol.ESTADO,tipoRol.USR_CREACION,tipoRol.FE_CREACION, 
                                  tipoRol.USR_MODIFICACION,tipoRol.FE_MODIFICACION ";
            $strFrom   = "FROM ADMI_TIPO_ROL tipoRol ";
            $strWhere  = "WHERE tipoRol.ESTADO in (:ESTADO) ";
            $objQuery->setParameter("ESTADO", $strEstado);
            if(!empty($intIdTipoRol))
            {
                $strWhere .= " AND tipoRol.ID_TIPO_ROL = :ID_TIPO_ROL ";
                $objQuery->setParameter("ID_TIPO_ROL", $intIdTipoRol);
            }
            if(!empty($strDescripcion))
            {
                $strWhere .= " AND lower(tipoRol.DESCRIPCION_TIPO_ROL) like lower(:DESCRIPCION_TIPO_ROL) ";
                $objQuery->setParameter("DESCRIPCION_TIPO_ROL", '%' . trim($strDescripcion) . '%');
            }
            $objRsmBuilder->addScalarResult('ID_TIPO_ROL', 'ID_TIPO_ROL', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION_TIPO_ROL', 'DESCRIPCION_TIPO_ROL', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $objRsmBuilder->addScalarResult('USR_CREACION', 'USR_CREACION', 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'date');
            $objRsmBuilder->addScalarResult('USR_MODIFICACION', 'USR_MODIFICACION', 'string');
            $objRsmBuilder->addScalarResult('FE_MODIFICACION', 'FE_MODIFICACION', 'date');

            $strSql  = $strSelect.$strFrom.$strWhere.$strOrder;
            $objQuery->setSQL($strSql);
            $arrayTipoRol['tipoRol'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayTipoRol['error'] = $strMensajeError;
        return $arrayTipoRol;
    }
}
