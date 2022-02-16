# Efficience

## Lancement du projet
Pour lancer le projet, merci de suivre ces commandes :

`make install` -> fera un composer install

`make up` -> lancera les conteneurs Docker (nginx, php, mailhog)

`make fixture` -> peuplera la table "Department" via le fichier de fixture src/DataFixtures/AppFixtures

## Accessibilité

Le serveur est accessible à l'adresse suivante : http://127.0.0.1:80

Mailhog est accessible à l'adresse suivante : http://127.0.0.1:8025

## Le projet

Lors de la soumission d'une fiche contact, les données sont enregistrées dans la base de données et un mail est envoyé au responsable du département.