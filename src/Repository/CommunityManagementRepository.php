<?php

namespace App\Repository;

use App\Entity\CommunityManagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommunityManagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommunityManagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommunityManagement[]    findAll()
 * @method CommunityManagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommunityManagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommunityManagement::class);
    }

    // /**
    //  * @return CommunityManagement[] Returns an array of CommunityManagement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommunityManagement
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
