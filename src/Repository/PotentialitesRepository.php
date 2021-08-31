<?php

namespace App\Repository;

use App\Entity\Potentialites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Potentialites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Potentialites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Potentialites[]    findAll()
 * @method Potentialites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PotentialitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Potentialites::class);
    }

    // /**
    //  * @return Potentialites[] Returns an array of Potentialites objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Potentialites
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
