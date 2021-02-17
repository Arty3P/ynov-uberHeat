# API Exemple - SF5 / API Platform / Docker-compose

## Pile applicative

Cette application d'exemple intègre 4 conteneurs :

- NGINX (frontal)
- PHP
- MySQL
- PhpMyAdmin

## Configuration

Créer un fichier `.env.local` avec les variables suivantes (remplacer les `xxxxxx` par les valeurs de configuration de votre environnement) :

```env
# pour Doctrine
DATABASE_URL=mysql://root:xxxxxxxxxxxxxxxx@db:3306/xxxxxxx?serverVersion=8.0

# Pour le conteneur MySQL
MYSQL_HOST=%
MYSQL_ROOT_PASSWORD=xxxxxxxxxxxxxxxx
```

## Lancer la pile applicative avec Docker-compose

Dans l'environnement de développement :

```bash
docker-compose -f docker-compose.yml -f docker-compose.development.yml up -d
```

Tester l'accès sur le port exposé par NGINX, dans notre cas `8500` : [http://localhost:8500](http://localhost:8500).

> Evolution possible : support HTTPS ! Piste à explorer : Serveur [Caddy](https://caddyserver.com/) à la place d'un serveur NGINX ([image Docker caddy](https://hub.docker.com/_/caddy))

## Débugger avec VSCode

Le Dockerfile du conteneur PHP contient 2 stage builds : un par défaut, qu'on peut utiliser en production, et un supplémentaire, `php_dev`, qui vient ajouter l'installation de XDebug.

La configuration docker-compose de développement vient donc installer XDebug dans le conteneur PHP, et définir le port sur lequel se brancher (dans notre exemple, fichier `docker-compose.development.yml`, le port défini est 25555).

Depuis VSCode, avec l'extension [PHP Debug](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug) installée, déclencher la création d'un fichier `launch.json` avec le panneau de debug.

Ensuite, il faut définir le port XDebug conformément à ce qu'on a défini avec Docker-compose, et mapper l'arborescence des fichiers locaux sur l'arborescence de fichiers du conteneur PHP.

Exemple de configuration `launch.json` :

```json
{
  "name": "Listen for XDebug",
  "type": "php",
  "request": "launch",
  "port": 25555,
  "pathMappings": {
    "/var/www/html/symfony": "${workspaceRoot}"
  }
}
```

> Le fichier `launch.json` est volontairement exclu de ce repository pour éviter de fournir un fichier inutile aux utilisateurs d'un autre IDE
