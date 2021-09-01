<?php

namespace App\Repository;

use App\Entity\FormatEncart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormatEncart|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormatEncart|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormatEncart[]    findAll()
 * @method FormatEncart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormatEncartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormatEncart::class);
    }

    // /**
    //  * @return FormatEncart[] Returns an array of FormatEncart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormatEncart
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
