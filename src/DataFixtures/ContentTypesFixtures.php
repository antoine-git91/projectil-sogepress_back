<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\CommandeStatus;
use App\Entity\EmplacementMagazine;
use App\Entity\FormatEncart;
use App\Entity\ReseauSocial;
use App\Entity\TypeHistorique;
use App\Entity\TypePotentialite;
use App\Entity\TypePrestationWeb;
use App\Entity\TypeSiteWeb;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class ContentTypesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // STATUS COMMANDE
        $commande_status = new CommandeStatus();
        $commande_status->setLibelle('test');
        $manager->persist($commande_status);

        // TypePrestationWeb
        $types_presta_web = [];

        $typePresta = new TypePrestationWeb();
        $typePresta->setLibelle('Site Internet');
        $manager->persist($typePresta);
        $types_presta_web[] = $typePresta;

        $typePresta = new TypePrestationWeb();
        $typePresta->setLibelle('Maintenance');
        $manager->persist($typePresta);
        $types_presta_web[] = $typePresta;

        $typePresta = new TypePrestationWeb();
        $typePresta->setLibelle('Hebergement');
        $manager->persist($typePresta);
        $types_presta_web[] = $typePresta;

        // TypeSiteWeb
        $types_sites = [];

        $typeSite = new TypeSiteWeb();
        $typeSite->setLibelle('E-Commerce');
        $manager->persist($typeSite);
        $types_sites[] = $typeSite;

        $typeSite = new TypeSiteWeb();
        $typeSite->setLibelle('Vitrine');
        $manager->persist($typeSite);
        $types_sites[] = $typeSite;

        // ReseauSocial
        $reseaux = [];

        $reseauSocial = new ReseauSocial();
        $reseauSocial->setLibelle('Facebook');
        $manager->persist($reseauSocial);
        $reseaux[] = $reseauSocial;

        $reseauSocial = new ReseauSocial();
        $reseauSocial->setLibelle('Twitter');
        $manager->persist($reseauSocial);
        $reseaux[] = $reseauSocial;

        $reseauSocial = new ReseauSocial();
        $reseauSocial->setLibelle('Instagram');
        $manager->persist($reseauSocial);
        $reseaux[] = $reseauSocial;

        // EmplacementMagazine
        $emplacements_mag = [];

        $emplacementMag = new EmplacementMagazine();
        $emplacementMag->setLibelle('Premiere Couverture');
        $manager->persist($emplacementMag);
        $emplacements_mag[] = $emplacementMag;

        $emplacementMag = new EmplacementMagazine();
        $emplacementMag->setLibelle('Deuxieme Couverture');
        $manager->persist($emplacementMag);
        $emplacements_mag[] = $emplacementMag;

        $emplacementMag = new EmplacementMagazine();
        $emplacementMag->setLibelle('Troisieme Couverture');
        $manager->persist($emplacementMag);
        $emplacements_mag[] = $emplacementMag;

        $emplacementMag = new EmplacementMagazine();
        $emplacementMag->setLibelle('Quatrieme Couverture');
        $manager->persist($emplacementMag);
        $emplacements_mag[] = $emplacementMag;

        $emplacementMag = new EmplacementMagazine();
        $emplacementMag->setLibelle('Page interieur');
        $manager->persist($emplacementMag);
        $emplacements_mag[] = $emplacementMag;

        // FormatEncart
        $formats_encart = [];

        $formatEncart = new FormatEncart();
        $formatEncart->setLibelle('1/8');
        $manager->persist($formatEncart);
        $formats_encart[] = $formatEncart;

        $formatEncart = new FormatEncart();
        $formatEncart->setLibelle('1/4');
        $manager->persist($formatEncart);
        $formats_encart[] = $formatEncart;

        $formatEncart = new FormatEncart();
        $formatEncart->setLibelle('1/2');
        $manager->persist($formatEncart);
        $formats_encart[] = $formatEncart;

        $formatEncart = new FormatEncart();
        $formatEncart->setLibelle('Pleine page');
        $manager->persist($formatEncart);
        $formats_encart[] = $formatEncart;

        // TYPES POTENTIALITES
        $types_potentialites = [];

        $typePotentialite = new TypePotentialite();
        $typePotentialite->setLibelle('Web');
        $manager->persist($typePotentialite);
        $types_potentialites[] = $typePotentialite;

        $typePotentialite = new TypePotentialite();
        $typePotentialite->setLibelle('Print');
        $manager->persist($typePotentialite);
        $types_potentialites[] = $typePotentialite;

        $typePotentialite = new TypePotentialite();
        $typePotentialite->setLibelle('Régie');
        $manager->persist($typePotentialite);
        $types_potentialites[] = $typePotentialite;

        $typePotentialite = new TypePotentialite();
        $typePotentialite->setLibelle('Contenu');
        $manager->persist($typePotentialite);
        $types_potentialites[] = $typePotentialite;

        $typePotentialite = new TypePotentialite();
        $typePotentialite->setLibelle('Community Management');
        $manager->persist($typePotentialite);
        $types_potentialites[] = $typePotentialite;

        // TYPE HISTORIQUE

        $typeHistorique = new TypeHistorique();
        $typeHistorique->setLibelle('Commande');
        $manager->persist($typeHistorique);

        $typeHistorique = new TypeHistorique();
        $typeHistorique->setLibelle('Client');
        $manager->persist($typeHistorique);

        $manager->flush();
    }
}