<?php

namespace App\Repository;

use App\Entity\EmplacementMagazine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmplacementMagazine|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmplacementMagazine|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmplacementMagazine[]    findAll()
 * @method EmplacementMagazine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmplacementMagazineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmplacementMagazine::class);
    }

    // /**
    //  * @return EmplacementMagazine[] Returns an array of EmplacementMagazine objects
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
    public function findOneBySomeField($value): ?EmplacementMagazine
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
