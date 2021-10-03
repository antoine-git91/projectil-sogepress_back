<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;

class CommandeDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $data
     * @param array $context
     * @return bool
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Commande;
    }

    public function persist($data, array $context = [])
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        return $data;
    }

    public function remove($data, array $context = [])
    {
        $supportMag = $data->getSupportMagazine();
        $supportMag->setCommande(0); //marche pas: must be instance of Commande (sauf que on cherche à supprimer la référence à Commande)
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}