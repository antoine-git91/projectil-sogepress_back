<?php

namespace App\Repository;

use App\Entity\SupportPrint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SupportPrint|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupportPrint|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupportPrint[]    findAll()
 * @method SupportPrint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportPrintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupportPrint::class);
    }

    // /**
    //  * @return SupportPrint[] Returns an array of SupportPrint objects
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
    public function findOneBySomeField($value): ?SupportPrint
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
