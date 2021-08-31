<?php

namespace App\Repository;

use App\Entity\Encart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Encart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Encart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Encart[]    findAll()
 * @method Encart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Encart::class);
    }

    // /**
    //  * @return Encart[] Returns an array of Encart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Encart
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
