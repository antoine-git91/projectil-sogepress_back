<?php

namespace App\Repository;

use App\Entity\RelanceStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelanceStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelanceStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelanceStatus[]    findAll()
 * @method RelanceStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelanceStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelanceStatus::class);
    }

    // /**
    //  * @return RelanceStatus[] Returns an array of RelanceStatus objects
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
    public function findOneBySomeField($value): ?RelanceStatus
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
