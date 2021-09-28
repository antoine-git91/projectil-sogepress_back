<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\CommandeStatus;
use App\Entity\CommunityManagement;
use App\Entity\Contact;
use App\Entity\Contenu;
use App\Entity\Encart;
use App\Entity\HistoriqueClient;
use App\Entity\Magazine;
use App\Entity\NafSousClasses;
use App\Entity\Potentialite;
use App\Entity\Relance;
use App\Entity\SupportMagazine;
use App\Entity\SupportPrint;
use App\Entity\SupportWeb;
use App\Entity\TypeHistorique;
use App\Entity\Ville;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
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

        // COMMANDES
        $commandes = [];

        for ($i = 0; $i < 20; $i++) {

            $commande = new Commande();
            $commande->setClient($clients[mt_rand(0, sizeof($clients) - 1)]);
            $commande->setStatut($manager->getRepository(CommandeStatus::class)->findOneByLibelle('test'));
            $commande->addContact($contacts[mt_rand(0, sizeof($contacts) - 1)]);
            $commande->setDebut(new DateTime('today'));
            $commande->setFin(new DateTime('today +6M'));
            $commande->setFacturation(mt_rand(100, 2000));
            $commande->setReduction(mt_rand(0, 100));
            $commande->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            $commande->setCreatedAt(new DateTimeImmutable());
            $commandes[] = $commande;
            $manager->persist($commande);
        }

        $manager->flush();

        // MAGAZINES
        $magazines = [];

        foreach ($clients as $client) {
            $magazine = new Magazine();
            $magazine->setNom('Magazine_'.$i);
            $magazine->setClient($client);
            $magazines[] = $magazine;
            $manager->persist($magazine);
        }

        $manager->flush();

        // PRODUITS
        $supports_mag = [];
        $commande_counter = 0;

        for ($i = 0; $i < 5; $i++) {
            $produit = new SupportMagazine();
            $produit->setCommande($commandes[$commande_counter]);
            $produit->addMagazine($magazines[mt_rand(0, sizeof($magazines) -1)]);
            $produit->setEdition('Septembre 2021');
            $produit->setPages(mt_rand(10, 50));
            $produit->setQuantite(mt_rand(100, 5000));
            $produit->setFinCommercialisation(new DateTime('now'));
            $manager->persist($produit);
            $supports_mag[] = $produit;
            $commande_counter++;
        }

        for ($i = 0; $i < 3; $i++) {
            $produit = new SupportWeb();
            $produit->setCommande($commandes[$commande_counter]);
            $produit->setTypePrestation($this->getReference(ContentTypesFixtures::TYPES_PRESTA_WEB[$i]));
            $produit->setTypeSite($this->getReference(ContentTypesFixtures::TYPES_SITE_WEB[mt_rand(0, 1)]));
            $produit->setUrl('https://www.totalement-random-' . ($i + 1) . '.com/');
            if ($i > 2) $produit->setEcheanceContrat(new DateTime('now'));
            $manager->persist($produit);
            $commande_counter++;
        }

        $produit = new SupportPrint();
        $produit->setCommande($commandes[$commande_counter]);
        $produit->setQuantite(500);
        $manager->persist($produit);
        $commande_counter++;

        for ($i = 0; $i < 6; $i++) {
            $produit = new Encart();
            $produit->setCommande($commandes[$commande_counter]);
            $produit->setSupportMagazine($supports_mag[mt_rand(0, sizeof($supports_mag) -1)]);
            $produit->setEmplacement($this->getReference(ContentTypesFixtures::TYPES_EMPLACEMENTS[mt_rand(0, sizeof(ContentTypesFixtures::TYPES_EMPLACEMENTS) -1 )]));
            $produit->setFormat($this->getReference(ContentTypesFixtures::TYPES_FORMAT_ENCARTS[mt_rand(0, sizeof(ContentTypesFixtures::TYPES_FORMAT_ENCARTS) -1 )]));
            $manager->persist($produit);
            $commande_counter++;
        }

        $contenu = new Contenu();
        $contenu->setCommande($commandes[$commande_counter]);
        $contenu->setTypeContenu(mt_rand(0, 1)); // Web ou Print
        $contenu->setFeuillets(mt_rand(0, 60));
        $manager->persist($contenu);
        $commande_counter++;

        $produit = new CommunityManagement();
        $produit->setCommande($commandes[$commande_counter]);
        $produit->setReseauSocial($this->getReference(ContentTypesFixtures::TYPES_RESEAUX[mt_rand(0, sizeof(ContentTypesFixtures::TYPES_RESEAUX) -1 )]));
        $produit->setPostMensuel(mt_rand(4, 31));
        $manager->persist($produit);

        $manager->flush();

        // POTENTIALITES
        for ($i = 0; $i < 6; $i++) {
            $potentialite = new Potentialite();
            $potentialite->setClient($clients[mt_rand(0, sizeof($clients) - 1)]);
            $potentialite->setTypePotentialite($this->getReference(ContentTypesFixtures::TYPES_POTENTIALITES[mt_rand(0, sizeof(ContentTypesFixtures::TYPES_POTENTIALITES) - 1 )]));
            $potentialite->setCommentaire('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ullamcorper ante nibh, nec consectetur felis pharetra id. Curabitur laoreet ex ut consequat malesuada. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut at gravida urna. Integer nec purus eu nibh lacinia congue sed a quam. In nec elit sed dui tempor posuere aliquam vitae est. Curabitur blandit imperdiet purus non lobortis. Nullam euismod porttitor est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum tincidunt at felis eget consectetur. Nunc nisl neque, convallis et justo eget, viverra euismod odio. Etiam euismod, dui sed laoreet sollicitudin, mauris ante sollicitudin eros, luctus faucibus ligula felis ac libero. Cras efficitur ligula eu aliquam semper.');
            if ($potentialite->getTypePotentialite()->getLibelle() === 'Régie') $potentialite->setMagazine($magazines[mt_rand(0, sizeof($magazines) - 1)]);
            $manager->persist($potentialite);
        }

        // HISTORIQUE CLIENT
        $historiques = [];

        foreach ($commandes as $key => $commande) {
            $historiqueClient = new HistoriqueClient();
            $historiqueClient->setClient($commande->getClient());
            $historiqueClient->setTypeHistorique($manager->getRepository(TypeHistorique::class)->findOneByLibelle('Commande'));
            $historiqueClient->setCommande($commande);
            $historiqueClient->setCommentaire('Ut at gravida urna. Integer nec purus eu nibh lacinia congue sed a quam. In nec elit sed dui tempor posuere aliquam vitae est. Curabitur blandit imperdiet purus non lobortis. Nullam euismod porttitor est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum tincidunt at felis eget consectetur.');
            $historiqueClient->setContact($contacts[mt_rand(0, sizeof($contacts) -1)]);
            $historiqueClient->setCreatedAt(new DateTimeImmutable);
            $historiqueClient->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            $manager->persist($historiqueClient);
            $historiques[] = $historiqueClient;
        }
        foreach ($clients as $client) {
            $historiqueClient = new HistoriqueClient();
            $historiqueClient->setClient($client);
            $historiqueClient->setTypeHistorique($manager->getRepository(TypeHistorique::class)->findOneByLibelle('Client'));
            $historiqueClient->setCommentaire('Ut at gravida urna. Integer nec purus eu nibh lacinia congue sed a quam. In nec elit sed dui tempor posuere aliquam vitae est. Curabitur blandit imperdiet purus non lobortis. Nullam euismod porttitor est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum tincidunt at felis eget consectetur.');
            $historiqueClient->setContact($contacts[mt_rand(0, sizeof($contacts) -1)]);
            $historiqueClient->setCreatedAt(new DateTimeImmutable);
            $historiqueClient->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            $manager->persist($historiqueClient);
            $historiques[] = $historiqueClient;
        }

        // RELANCES
        $relances = [];

        for ($i = 0; $i < 10; $i++) {
            $relance = new Relance();
            $relance->setClient($clients[mt_rand(0, sizeof($clients) - 1)]);
            if ($i % 2 == 0) {
                $relance->setTypeRelance(1); // true=Commande
                $relance->setCommande($commandes[mt_rand(0, sizeof($commandes) - 1)]);
            } else {
                $relance->setTypeRelance(0); // false=Prospect
            }
            $relance->setObjet('Lorem ipsum dolor sit amet');
            $relance->setContenu('Ut at gravida urna. Integer nec purus eu nibh lacinia congue sed a quam. In nec elit sed dui tempor posuere aliquam vitae est. Curabitur blandit imperdiet purus non lobortis. Nullam euismod porttitor est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum tincidunt at felis eget consectetur.');
            $relance->setDateEcheance(new DateTime('now'));
            $relance->setStatut(mt_rand(0, 1)); // true=En cours  false=Archivé
            $relance->setCreatedAt(new DateTimeImmutable('now'));
            $manager->persist($relance);
            $relances[] = $relance;
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [UserFixtures::class];
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
