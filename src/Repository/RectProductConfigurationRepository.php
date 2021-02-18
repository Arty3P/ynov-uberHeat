<?php

namespace App\Repository;

use App\Entity\RectProductConfiguration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RectProductConfiguration|null find($id, $lockMode = null, $lockVersion = null)
 * @method RectProductConfiguration|null findOneBy(array $criteria, array $orderBy = null)
 * @method RectProductConfiguration[]    findAll()
 * @method RectProductConfiguration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RectProductConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RectProductConfiguration::class);
    }

    // /**
    //  * @return RectProductConfiguration[] Returns an array of RectProductConfiguration objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RectProductConfiguration
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
