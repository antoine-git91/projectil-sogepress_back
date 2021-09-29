<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public const USER_REFERENCE = 'test_user';
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // USER
        $test_user = new User();
<<<<<<< HEAD
        $test_user->setNom('Projectil');
        $test_user->setPrenom('Sogepress');
        $test_user->setEmail('test@test.com');
        $test_user->setPassword($this->userPasswordHasher->hashPassword($test_user, 'vErySecure_1234'));
=======
        $test_user->setNom('Projectil2');
        $test_user->setPrenom('Sogepress2');
        $test_user->setEmail('adresse@mail.loc');
        $test_user->setPassword('1234');
>>>>>>> BLG
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