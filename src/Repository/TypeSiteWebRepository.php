<?php

namespace App\Repository;

use App\Entity\TypeSiteWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeSiteWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSiteWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSiteWeb[]    findAll()
 * @method TypeSiteWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSiteWebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSiteWeb::class);
    }

    // /**
    //  * @return TypeSiteWeb[] Returns an array of TypeSiteWeb objects
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
    public function findOneBySomeField($value): ?TypeSiteWeb
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
