<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public const USER_REFERENCE = 'test_user';

    public function load(ObjectManager $manager)
    {
        // USER
        $test_user = new User();
        $test_user->setNom('Projectil2');
        $test_user->setPrenom('Sogepress2');
        $test_user->setEmail('adresse@mail.loc');
        $test_user->setPassword('1234');
        $test_user->setRoles(['ROLE_COMMERCIAL']);
        $test_user->setCreatedAt(new DateTimeImmutable('now'));
        $manager->persist($test_user);
        $manager->flush();
        $this->addReference(self::USER_REFERENCE, $test_user); // ajout de la référence pour inclusion dans les autres fixtures
    }

    public function getDependencies() {
        return [ContentTypesFixtures::class];
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}