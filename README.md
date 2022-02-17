# Efficience

## Lancement du projet
Pour lancer le projet, merci de suivre la commande :

`make start`

Lors du input `docker-compose exec php bin/console doctrine:migrations:migrate` 
-> faire entrer


Lors du input `docker-compose exec bin/console doctrine:fixtures:load`
-> taper yes


## Accessibilité

Le serveur est accessible à l'adresse suivante : http://127.0.0.1:80

Mailhog est accessible à l'adresse suivante : http://127.0.0.1:8025

## Le projet

Lors de la soumission d'une fiche contact, les données sont enregistrées dans la base de données et un mail est envoyé au responsable du département.