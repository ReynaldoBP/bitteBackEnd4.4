<?php

namespace App\Repository;

use App\Entity\InfoCuponPromocion;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method InfoCuponPromocion|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoCuponPromocion|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoCuponPromocion[]    findAll()
 * @method InfoCuponPromocion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoCuponPromocionRepository extends \Doctrine\ORM\EntityRepository
{
    // /**
    //  * @return InfoCuponPromocion[] Returns an array of InfoCuponPromocion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoCuponPromocion
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
