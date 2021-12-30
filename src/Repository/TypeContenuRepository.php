<?php

namespace App\Repository;

use App\Entity\TypeContenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeContenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeContenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeContenu[]    findAll()
 * @method TypeContenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeContenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeContenu::class);
    }

    // /**
    //  * @return TypeContenu[] Returns an array of TypeContenu objects
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
    public function findOneBySomeField($value): ?TypeContenu
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
