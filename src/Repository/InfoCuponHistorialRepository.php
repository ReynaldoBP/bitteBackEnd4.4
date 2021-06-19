<?php

namespace App\Repository;

use App\Entity\InfoCuponHistorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoCuponHistorial|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoCuponHistorial|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoCuponHistorial[]    findAll()
 * @method InfoCuponHistorial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoCuponHistorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoCuponHistorial::class);
    }

    // /**
    //  * @return InfoCuponHistorial[] Returns an array of InfoCuponHistorial objects
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
    public function findOneBySomeField($value): ?InfoCuponHistorial
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
