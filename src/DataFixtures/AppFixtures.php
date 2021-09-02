<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $client = new Client();
        $client->setRaisonSociale('CEFIM');
        $client->setStatut(1);
//        $client->set
        $client->setCreatedAt(new \DateTimeImmutable());

        $manager->flush();
    }
}
