<?php

namespace App\Repository;

use App\Entity\Potentialite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Potentialite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Potentialite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Potentialite[]    findAll()
 * @method Potentialite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PotentialitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Potentialite::class);
    }

    // /**
    //  * @return Potentialite[] Returns an array of Potentialite objects
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
    public function findOneBySomeField($value): ?Potentialite
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
