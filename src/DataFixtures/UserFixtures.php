<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public const ADMIN_REFERENCE = 'admin_test';
    public const COMMERCIAL_REFERENCE = 'commercial_test';
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // USER
        $test_user = new User();
        $test_user->setNom('Projectil-Sogepress');
        $test_user->setPrenom('Admin');
        $test_user->setEmail('admin@test.com');
        $test_user->setPassword($this->userPasswordHasher->hashPassword($test_user, 'vErySecure_1234'));
        $test_user->setRoles(['ROLE_ADMIN']);
        $test_user->setCreatedAt(new DateTimeImmutable('now'));
        $manager->persist($test_user);
        $this->addReference(self::ADMIN_REFERENCE, $test_user); // ajout de la référence pour inclusion dans les autres fixtures

        $test_user = new User();
        $test_user->setNom('Projectil-Sogepress');
        $test_user->setPrenom('Commercial');
        $test_user->setEmail('commercial@test.com');
        $test_user->setPassword($this->userPasswordHasher->hashPassword($test_user, 'vErySecure_5678'));
        $test_user->setRoles(['ROLE_COMMERCIAL']);
        $test_user->setCreatedAt(new DateTimeImmutable('now'));
        $manager->persist($test_user);
        $this->addReference(self::COMMERCIAL_REFERENCE, $test_user); // ajout de la référence pour inclusion dans les autres fixtures

        $manager->flush();
    }

    public function getDependencies() {
        return [ContentTypesFixtures::class];
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}