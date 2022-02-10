<?php

namespace App\Repository;

use App\Entity\Relance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Relance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Relance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Relance[]    findAll()
 * @method Relance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Relance::class);
    }

    /**
     * @return Relance[] Returns an array of Relance objects
     */
    public function getRelancesValidByClient($client)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.client = :client')
            ->setParameter('client', $client)
            ->andWhere('r.status = 1')
            ->orderBy('r.dateEcheance', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Relance[] Returns an array of Relance objects
     */
    public function getRelancesValidByCommande($commande)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.commande = :commande')
            ->setParameter('commande', $commande)
            ->andWhere('r.status = 1')
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Relance
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
