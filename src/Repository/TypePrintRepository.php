<?php

namespace App\Repository;

use App\Entity\TypePrint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypePrint|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePrint|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePrint[]    findAll()
 * @method TypePrint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePrintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePrint::class);
    }

    // /**
    //  * @return TypePrint[] Returns an array of TypePrint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypePrint
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
