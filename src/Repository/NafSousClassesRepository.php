<?php

namespace App\Repository;

use App\Entity\NafSousClasses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NafSousClasses|null find($id, $lockMode = null, $lockVersion = null)
 * @method NafSousClasses|null findOneBy(array $criteria, array $orderBy = null)
 * @method NafSousClasses[]    findAll()
 * @method NafSousClasses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NafSousClassesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NafSousClasses::class);
    }

    // /**
    //  * @return NafSousClasses[] Returns an array of NafSousClasses objects
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
    public function findOneBySomeField($value): ?NafSousClasses
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
