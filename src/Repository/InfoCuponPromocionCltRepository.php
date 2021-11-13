<?php

namespace App\Repository;

use App\Entity\InfoCuponPromocionClt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoCuponPromocionClt|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoCuponPromocionClt|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoCuponPromocionClt[]    findAll()
 * @method InfoCuponPromocionClt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoCuponPromocionCltRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoCuponPromocionClt::class);
    }

    // /**
    //  * @return InfoCuponPromocionClt[] Returns an array of InfoCuponPromocionClt objects
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
    public function findOneBySomeField($value): ?InfoCuponPromocionClt
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
