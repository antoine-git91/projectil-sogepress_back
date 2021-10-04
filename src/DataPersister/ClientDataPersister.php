<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Client;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class ClientDataPersister implements ContextAwareDataPersisterInterface
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
        return $data instanceof Client;
    }

    public function persist($data, array $context = [])
    {
        if (is_null($data->getCreatedAt())) {
            $data->setCreatedAt(new DateTimeImmutable());
        } else {
            $data->setModifiedAt(new DateTime());
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        return $data;
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}