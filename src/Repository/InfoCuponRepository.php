<?php

namespace App\Repository;

use App\Entity\InfoCupon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoCupon|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoCupon|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoCupon[]    findAll()
 * @method InfoCupon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoCuponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoCupon::class);
    }

    // /**
    //  * @return InfoCupon[] Returns an array of InfoCupon objects
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
    public function findOneBySomeField($value): ?InfoCupon
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
