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
    // /**
    //  * @return AdmiTipoCupon[] Returns an array of AdmiTipoCupon objects
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
    public function findOneBySomeField($value): ?AdmiTipoCupon
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
