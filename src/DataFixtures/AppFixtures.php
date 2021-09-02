<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Client;
use App\Entity\NafSousClasses;
use App\Repository\NafSousClassesRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // CLIENTS
        $clients = [];

        $client = new Client();
        $client->setRaisonSociale('CEFIM');
        $client->setStatut(1);
        $client->setNafSousClasse($manager->getRepository('NafSousClasse')->find()); // mettre un id
        $client->setEmail('contact@cefim.eu');
        $client->setSiteInternet('https://www.cefim.eu/');
        $client->setTypeFacturation(1);
        $client->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($client);
        $clients[] = $client;

        $client = new Client();
        $client->setRaisonSociale('SNEXI');
        $client->setStatut(0);
        $client->setNafSousClasse($manager->getRepository('NafSousClasse')->find()); // mettre un id
        $client->setEmail('contact@snexi.fr');
        $client->setSiteInternet('https://www.snexi.fr/');
        $client->setTypeFacturation(1);
        $client->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($client);
        $clients[] = $client;

        $client = new Client();
        $client->setRaisonSociale('Mairie de Châteaudun');
        $client->setStatut(0);
        $client->setNafSousClasse($manager->getRepository('NafSousClasse')->find()); // mettre un id
        $client->setEmail('contact@mairie-chateaudun.fr');
        $client->setSiteInternet('https://www.ville-chateaudun.fr/');
        $client->setTypeFacturation(0);
        $client->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($client);
        $clients[] = $client;

        $manager->flush();

        // ADRESSES
        $adresses = [];

        $adresse = new Adresse();
        $adresse->setStatutAdresse(0);
        $adresse->setNumero('32');
        $adresse->setTypeVoie('Avenue');
        $adresse->setNomVoie('Marcel Dassault');
        $adresse->setVille(); // 37200 Tours
        $adresse->setClient($clients[1]);
        $adresses[] = $adresse;
        $manager->persist($adresse);

        $adresse = new Adresse();
        $adresse->setStatutAdresse(0);
        $adresse->setNumero('7');
        $adresse->setTypeVoie('rue');
        $adresse->setNomVoie('du Docteur Herpin');
        $adresse->setVille(); // 37000 Tours
        $adresse->setClient($clients[1]);
        $adresses[] = $adresse;
        $manager->persist($adresse);

        $adresse = new Adresse();
        $adresse->setStatutAdresse(1);
        $adresse->setNumero('8');
        $adresse->setTypeVoie('rue');
        $adresse->setNomVoie('du Docteur Herpin');
        $adresse->setVille(); // 37000 Tours
        $adresse->setClient($clients[1]);
        $adresses[] = $adresse;
        $manager->persist($adresse);

        $adresse = new Adresse();
        $adresse->setStatutAdresse(0);
        $adresse->setNumero('2');
        $adresse->setTypeVoie('Place');
        $adresse->setNomVoie('du 18 Octobre');
        $adresse->setVille(); // 28200 Châteaudun
        $adresse->setClient($clients[2]);
        $adresses[] = $adresse;
        $manager->persist($adresse);

        $manager->flush();

        // CONTACTS

    }

}
