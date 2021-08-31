<?php

namespace App\Repository;

use App\Entity\SupportWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SupportWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupportWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupportWeb[]    findAll()
 * @method SupportWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportWebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupportWeb::class);
    }

    // /**
    //  * @return SupportWeb[] Returns an array of SupportWeb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SupportWeb
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
