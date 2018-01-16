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
2. Entrer dans le dossier cloné
3. Copier le fichier env-example :
```
cp env-example .env
```

4. Lancer les containers docker :
```
docker-compose up -d
```

5. Enjoy ! :)
