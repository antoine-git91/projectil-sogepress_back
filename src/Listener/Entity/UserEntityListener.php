<?php

namespace App\Listener\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserEntityListener
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
         UserPasswordHasherInterface $passwordHasher
    ) {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @param User $user
     */
    public function preUpdateHandler(User $user): void
    {
        if ($user->getPlainPassword() !== null) {
            $password = $this->passwordHasher->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
        }
    }
}