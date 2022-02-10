<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getCa($user)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT SUM(c.facturation)
        FROM App\Entity\Commande c
        WHERE c.user = :user
        AND SUBSTRING(c.fin,6,2) = SUBSTRING(CURRENT_DATE(), 6,2)'
        )->setParameter('user', $user);

        return $query->getSingleScalarResult();
    }

    public function getCaByMonthAndClient($client)
    {
        return $this->createQueryBuilder('c')
            ->select('substring(c.fin, 1,7) AS month, sum(c.facturation) as total')
            ->where('c.client = :client')
            ->setParameter('client', $client)
            ->groupBy('month')
            ->getQuery()
            ->getResult()
        ;


    }


//    /**
//     * @throws \Doctrine\ORM\NonUniqueResultException
//     */
//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
