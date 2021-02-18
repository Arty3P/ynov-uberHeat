<?php

namespace App\Repository;

use App\Entity\CircProductConfiguration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CircProductConfiguration|null find($id, $lockMode = null, $lockVersion = null)
 * @method CircProductConfiguration|null findOneBy(array $criteria, array $orderBy = null)
 * @method CircProductConfiguration[]    findAll()
 * @method CircProductConfiguration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CircProductConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CircProductConfiguration::class);
    }

    // /**
    //  * @return CircProductConfiguration[] Returns an array of CircProductConfiguration objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CircProductConfiguration
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
