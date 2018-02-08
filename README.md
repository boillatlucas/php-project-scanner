# API Project Scanner

## Présentation
Cet outil est une API permettant d'analyser un projet PHP à partir d'une URL d'un repository GITHUB.
Il permet d'avoir un rapport sur des stats et des problèmes de sécurité liés au code du projet Github.

Plusieurs projets peuvent être demandés à être analyser. Lorsqu'un projet est terminé, un email est envoyé pour prévenir l'utilisateur.

[Lien du Front Github](https://github.com/boillatlucas/php-project-front)

## Structure

- project_api : Application Laravel (l'API)
- docker : containers docker permettant de faire tourner l'appli laravel
	- PROD:
	    - **App Laravel - PHP-FPM/nginx** : http://localhost:8888
        - **RabbitMQ (interface)** : http://localhost:15672
        - **Lancement des outils d'analyse - PHP-WORKER**
        - **MySQL**
    - DEV
        - **PhpMyAdmin** : http://localhost:8080
        - **MailDev** : http://localhost:1080
- docs : API_Usage


## Requierments 
- Avoir installé docker compose sur la machine [Lien utile](https://gist.githubusercontent.com/AlexBDev/8fd269c708bb0a1f892d98d02abb80e1/raw/0738610278b81de1c5052e77a1b35da59a9370e7/install_it.sh)

## Installation

1. Cloner ce repot git
2. Entrer dans le dossier cloné **docker**
3. Copier le fichier env-example :
    ```
    cp env-example .env
    ```

4. Lancer les containers docker :
    ```
    ./docker-build.production.sh && docker-compose up -d
    ```

5. Pour la première fois, créer une base de données vide sur phpmyadmin

6. Aller dans le dossier de l'application laravel en ligne de commande : 
   ```
   docker-compose exec php-fpm bash
   ```
   
7. Création des tables dans la BDD (ajouter l'option `--seed` pour la population des tables avec données fictives)
    ```
    php artisan migrate:install
    ``` 

8. Pour la gestion de l'authentification (avec Passport), faire un :
    ```
    php artisan passport:install
    ```

9. Enjoy ! :)


## Utilisation API

Afin d'utiliser l'API, un token est requis.

Pour ne pas utiliser l'authentification, passer la variable d'environnement 'ACTIVE_AUTH_TOKEN' à false dans le fichier .env

[Voir ici](./docs/API_Usage.md)

