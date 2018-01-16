# API Project Scanner

- project_api : Application Laravel (l'API)
- laradock : containers docker permettant de faire tourner l'appli laravel
	- php
	- mysql
	- rabbitmq
	- maildev


## Requierments 
- Avoir installé docker compose sur la machine

## Installation

1. Cloner ce repot git
2. Entrer dans le dossier cloné **laradock**
3. Copier le fichier env-example :
```
cp env-example .env
```

4. Lancer les containers docker :
```
docker-compose up -d
```

5. Enjoy ! :)


## Utilisation

- **App Laravel** : http://localhost:8888
- **PhpMyAdmin** : http://localhost:8080
- **RabbitMQ (interface)** : http://localhost:15672
- **MailDev** : http://localhost:1080

- Pour la première fois, créer la database 'phpscanner' sur phpmyadmin

```
php artisan migrate:install
``` 

- Lancer la migration (création des tables de la bdd) et des seed (poulation des tables de la bdd) :
```
php artisan migrate:refresh --seed
``` 

