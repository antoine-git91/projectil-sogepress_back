# Back-end du projet de CRM pour Projectil-Sogepress

Mise à disposition d'une API pour le front-end du projet. 
Réalisé sous Symfony avec API Plateform

Autres dépôts du projet :
- projet front : https://github.com/LouisonDupont/projectil-sogepress_front
- documentation : https://github.com/LouisonDupont/projectil-sogepress_doc

## Démarrer

### Clonage repo
```
git clone git@github.com:LouisonDupont/projectil-sogepress_back.git
cd projectil-sogepress_back
```

### Installation
run `composer install` pour avoir les vendors à jour

### base de données
Créer un fichier .env.local et paramétrer DATABASE_URL avec vos données de connexion MySQL locales. Choisir un nom pour la base de données de test.

```
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
```

Charger les données dans la base en deux étapes :
- importer dans phpmyadmin les fichiers villes.sql et data_naf.sql (désactiver la vérification des clés étrangères. Rééxécuter l'import en cas d'erreur jusqu'à ce que les 5 tables naf aient des données chargées)
- PUIS, exécuter les fixtures avec `symfony console doctrine:fixtures:load --group=group1 --append`

### Authentification JWT
Générer les clés de chiffrement `symfony console lexik:jwt:generate-keypair`


## Autres

### Documentation
Schéma de données, API : [https://github.com/LouisonDupont/projectil-sogepress_doc](https://github.com/LouisonDupont/projectil-sogepress_front)

### redémarrer proprement
Pour repartir à zéro avec la base de données en cas de besoin,
run `symfony console doctrine:database:drop -f`
(repartir ensuite à partir de doctrine:database:create)

