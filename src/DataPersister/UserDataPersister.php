<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $userPasswordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param $data
     * @param array $context
     * @return bool
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = []): object
    {
        if ($data->getPlainPassword() !== null) {
            $password = $this->userPasswordEncoder->hashPassword($data, $data->getPlainPassword());
            $data->setPassword($password);
        }

        if (is_null($data->getCreatedAt())) {
            $data->setCreatedAt(new DateTimeImmutable());
        } else {
            $data->setUpdatedAt(new DateTime());
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();
        return $data;
    }

    public function remove($data, array $context = []): void
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}