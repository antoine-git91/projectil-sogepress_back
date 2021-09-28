# Back-end du projet de CRM pour Projectil-Sogepress

Mise à disposition d'une API pour le front-end du projet. 
Réalisé sous Symfony avec API Plateform

Autres dépôts du projet :
- projet front : https://github.com/LouisonDupont/projectil-sogepress_front
- documentation : https://github.com/LouisonDupont/projectil-sogepress_doc

## Installation

```
git clone git@github.com:LouisonDupont/projectil-sogepress_back.git
cd projectil-sogepress_back
```

Puis, créer un fichier .env.local et paramétrer DATABASE_URL avec vos données de connexion MySQL locales. Choisir un nom pour la base de données de test.

```
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
```

Charger les données dans la base en deux étapes :
- importer dans phpmyadmin les fichiers villes.sql et data_naf.sql (désactiver la vérification des clés étrangères. Rééxécuter l'import en cas d'erreur jusqu'à ce que les 5 tables naf aient des données chargées)
- PUIS, exécuter les fixtures avec `symfony console doctrine:fixtures:load --group=group1 --append`


