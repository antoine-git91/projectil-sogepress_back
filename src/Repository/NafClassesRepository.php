<?php

namespace App\Repository;

use App\Entity\NafClasses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NafClasses|null find($id, $lockMode = null, $lockVersion = null)
 * @method NafClasses|null findOneBy(array $criteria, array $orderBy = null)
 * @method NafClasses[]    findAll()
 * @method NafClasses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NafClassesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NafClasses::class);
    }

    // /**
    //  * @return NafClasses[] Returns an array of NafClasses objects
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
    public function findOneBySomeField($value): ?NafClasses
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
