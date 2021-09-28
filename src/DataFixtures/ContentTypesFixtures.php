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
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class ContentTypesFixtures extends Fixture implements FixtureGroupInterface
{
    // tableaux de références pour charger les items dans d'autres fixtures
    public const TYPES_PRESTA_WEB = ['Site Internet', 'Maintenance', 'Hebergement'];
    public const TYPES_SITE_WEB = ['E-commerce', 'Vitrine'];
    public const TYPES_RESEAUX = ['Facebook', 'Twitter', 'Instagram'];
    public const TYPES_EMPLACEMENTS = ['Premiere Couverture', 'Deuxième Couverture', 'Troisième Couverture', 'Quatrième Couverture', 'Page intérieure'];
    public const TYPES_FORMAT_ENCARTS = ['1/8', '1/4', '1/2', 'Pleine page'];
    public const TYPES_POTENTIALITES = ['Web', 'Print', 'Régie', 'Contenu', 'Community Management'];
    public const TYPE_HISTORIQUE = ['Commande', 'Client'];

    public function load(ObjectManager $manager)
    {
        // Statuts commande
        $commande_status = new CommandeStatus();
        $commande_status->setLibelle('test');
        $manager->persist($commande_status);

        // TypePrestationWeb
        $types_presta_web = [];

        foreach (self::TYPES_PRESTA_WEB as $libelle) {
            $typePresta = new TypePrestationWeb();
            $typePresta->setLibelle($libelle);
            $types_presta_web[] = $typePresta;
            $this->addReference(self::TYPES_PRESTA_WEB[array_search($libelle, self::TYPES_PRESTA_WEB)], $typePresta);
            $manager->persist($typePresta);
        }

        // TypeSiteWeb
        $types_sites = [];

        foreach (self::TYPES_SITE_WEB as $libelle) {
            $typeSite = new TypeSiteWeb();
            $typeSite->setLibelle($libelle);
            $types_sites[] = $typeSite;
            $this->addReference(self::TYPES_SITE_WEB[array_search($libelle, self::TYPES_SITE_WEB)], $typeSite);
            $manager->persist($typeSite);
        }

        // Réseau Social
        $reseaux = [];

        foreach (self::TYPES_RESEAUX as $libelle) {
            $reseauSocial = new ReseauSocial();
            $reseauSocial->setLibelle($libelle);
            $reseaux[] = $reseauSocial;
            $this->addReference(self::TYPES_RESEAUX[array_search($libelle, self::TYPES_RESEAUX)], $reseauSocial);
            $manager->persist($reseauSocial);
        }


        // EmplacementMagazine
        $emplacements_mag = [];

        foreach (self::TYPES_EMPLACEMENTS as $libelle) {
            $emplacementMag = new EmplacementMagazine();
            $emplacementMag->setLibelle($libelle);
            $emplacements_mag[] = $emplacementMag;
            $this->addReference(self::TYPES_EMPLACEMENTS[array_search($libelle, self::TYPES_EMPLACEMENTS)], $emplacementMag);
            $manager->persist($emplacementMag);
        }

        // FormatEncart
        $formats_encart = [];

        foreach (self::TYPES_FORMAT_ENCARTS as $libelle) {
            $formatEncart = new FormatEncart();
            $formatEncart->setLibelle($libelle);
            $formats_encart[] = $formatEncart;
            $this->addReference(self::TYPES_FORMAT_ENCARTS[array_search($libelle, self::TYPES_FORMAT_ENCARTS)], $formatEncart);
            $manager->persist($formatEncart);
        }

        // Types potentialités
        $types_potentialites = [];

        foreach (self::TYPES_POTENTIALITES as $libelle) {
            $typePotentialite = new TypePotentialite();
            $typePotentialite->setLibelle('Web');
            $types_potentialites[] = $typePotentialite;
            $this->addReference(self::TYPES_POTENTIALITES[array_search($libelle, self::TYPES_POTENTIALITES)], $typePotentialite);
            $manager->persist($typePotentialite);
        }

        // Type historique

        foreach (self::TYPE_HISTORIQUE as $libelle) {
            $typeHistorique = new TypeHistorique();
            $typeHistorique->setLibelle($libelle);
            $this->addReference(self::TYPE_HISTORIQUE[array_search($libelle, self::TYPE_HISTORIQUE)], $typeHistorique);
            $manager->persist($typeHistorique);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}