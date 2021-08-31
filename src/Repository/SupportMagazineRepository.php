<?php

namespace App\Repository;

use App\Entity\SupportMagazine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SupportMagazine|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupportMagazine|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupportMagazine[]    findAll()
 * @method SupportMagazine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportMagazineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupportMagazine::class);
    }

    // /**
    //  * @return SupportMagazine[] Returns an array of SupportMagazine objects
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
    public function findOneBySomeField($value): ?SupportMagazine
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
