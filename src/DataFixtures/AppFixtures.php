<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Client;
use App\Entity\Contact;
use App\Entity\NafSousClasses;
use App\Entity\Ville;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager)
    {
        // CLIENTS
        $clients = [];

        $client = new Client();
        $client->setRaisonSociale('CEFIM');
        $client->setStatut(1);
        $client->setNafSousClasse($this->entityManager->getRepository(NafSousClasses::class)->findOneByCode('85.59A'));
        $client->setEmail('contact@cefim.eu');
        $client->setSiteInternet('https://www.cefim.eu/');
        $client->setTypeFacturation(1);
        $client->setCreatedAt(new DateTimeImmutable());
        $manager->persist($client);
        $clients[] = $client;

        $client = new Client();
        $client->setRaisonSociale('SNEXI');
        $client->setStatut(0);
        $client->setNafSousClasse($this->entityManager->getRepository(NafSousClasses::class)->findOneByCode('71.12B'));
        $client->setEmail('contact@snexi.fr');
        $client->setSiteInternet('https://www.snexi.fr/');
        $client->setTypeFacturation(1);
        $client->setCreatedAt(new DateTimeImmutable());
        $manager->persist($client);
        $clients[] = $client;

        $client = new Client();
        $client->setRaisonSociale('Mairie de Châteaudun');
        $client->setStatut(0);
        $client->setNafSousClasse($this->entityManager->getRepository(NafSousClasses::class)->findOneByCode('84.11Z'));
        $client->setEmail('contact@mairie-chateaudun.fr');
        $client->setSiteInternet('https://www.ville-chateaudun.fr/');
        $client->setTypeFacturation(0);
        $client->setCreatedAt(new DateTimeImmutable());
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
        $adresse->setVille($manager->getRepository(Ville::class)->findOneByNom('Tours'));
        $adresse->setClient($clients[1]);
        $adresses[] = $adresse;
        $manager->persist($adresse);

        $adresse = new Adresse();
        $adresse->setStatutAdresse(0);
        $adresse->setNumero('7');
        $adresse->setTypeVoie('rue');
        $adresse->setNomVoie('du Docteur Herpin');
        $adresse->setVille($manager->getRepository(Ville::class)->findOneByNom('Tours'));
        $adresse->setClient($clients[1]);
        $adresses[] = $adresse;
        $manager->persist($adresse);

        $adresse = new Adresse();
        $adresse->setStatutAdresse(1);
        $adresse->setNumero('8');
        $adresse->setTypeVoie('rue');
        $adresse->setNomVoie('du Docteur Herpin');
        $adresse->setVille($manager->getRepository(Ville::class)->findOneByNom('Tours'));
        $adresse->setClient($clients[1]);
        $adresses[] = $adresse;
        $manager->persist($adresse);

        $adresse = new Adresse();
        $adresse->setStatutAdresse(0);
        $adresse->setNumero('2');
        $adresse->setTypeVoie('Place');
        $adresse->setNomVoie('du 18 Octobre');
        $adresse->setVille($manager->getRepository(Ville::class)->findOneByNom('Châteaudun'));
        $adresse->setClient($clients[2]);
        $adresses[] = $adresse;
        $manager->persist($adresse);

        $manager->flush();

        // CONTACTS
        $contacts = [];

        $contact = new Contact();
        $contact->setClient($clients[0]);
        $contact->setDefaut(1);
        $contact->setNom('Lawniczak');
        $contact->setPrenom('Benoist');
        $contact->setFonction('Référent formation');
        $contact->setEmail('blawniczak@cefim.eu');
        $contact->setTel('0607080910');
        $contact->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($contact);
        $contacts[] = $contact;

        $contact = new Contact();
        $contact->setClient($clients[1]);
        $contact->setDefaut(1);
        $contact->setNom('Girault');
        $contact->setPrenom('David');
        $contact->setFonction('Tuteur caféiné');
        $contact->setEmail('dgirault@snexi.fr');
        $contact->setTel('0247753131');
        $contact->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($contact);
        $contacts[] = $contact;

        $contact = new Contact();
        $contact->setClient($clients[1]);
        $contact->setDefaut(0);
        $contact->setNom('Voituriez');
        $contact->setPrenom('Pierre-Michel');
        $contact->setFonction('Directeur');
        $contact->setEmail('pmvoituriez@snexi.fr');
        $contact->setTel('0247310879');
        $contact->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($contact);
        $contacts[] = $contact;

        $contact = new Contact();
        $contact->setClient($clients[2]);
        $contact->setDefaut(1);
        $contact->setNom('Verdier');
        $contact->setPrenom('Fabien');
        $contact->setFonction('Maire');
        $contact->setEmail('fabienverdier.dunois@gmail.com');
        $contact->setTel('0629929819');
        $contact->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($contact);
        $contacts[] = $contact;

        $manager->flush();
    }
}
