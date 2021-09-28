<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // USER
        $test_user = new User();
        $test_user->setNom('Projectil');
        $test_user->setPrenom('Sogepress');
        $test_user->setEmail('test@test.com');
        $test_user->setPassword('vErySecure_1234');
        $test_user->setRoles(['ROLE_COMMERCIAL']);
        $test_user->setCreatedAt(new DateTimeImmutable('now'));
        $manager->persist($test_user);
        $manager->flush();
    }
}