<?php

namespace App\Repository;

use App\Entity\NafDivisions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NafDivisions|null find($id, $lockMode = null, $lockVersion = null)
 * @method NafDivisions|null findOneBy(array $criteria, array $orderBy = null)
 * @method NafDivisions[]    findAll()
 * @method NafDivisions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NafDivisionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NafDivisions::class);
    }

    // /**
    //  * @return NafDivisions[] Returns an array of NafDivisions objects
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
    public function findOneBySomeField($value): ?NafDivisions
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
