<?php

namespace App\Repository;

use App\Entity\NafSections;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NafSections|null find($id, $lockMode = null, $lockVersion = null)
 * @method NafSections|null findOneBy(array $criteria, array $orderBy = null)
 * @method NafSections[]    findAll()
 * @method NafSections[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NafSectionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NafSections::class);
    }

    // /**
    //  * @return NafSections[] Returns an array of NafSections objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NafSections
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
