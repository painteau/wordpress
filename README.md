# wordpress

Image Docker WordPress personnalisée, basée sur `wordpress:latest` (Apache), avec :

- **WP-CLI** pré-installé (`wp` disponible dans le conteneur)
- **uploads.ini** configuré (500MB upload, 600s exec)

## Image

```
ghcr.io/painteau/wordpress:latest
```

## Usage

Remplacer `wordpress:latest` par `ghcr.io/painteau/wordpress:latest` dans les docker-compose.
Le volume `uploads.ini` n'est plus nécessaire.

```yaml
services:
  wordpress:
    image: ghcr.io/painteau/wordpress:latest
    ...
```

## Build automatique

GitHub Actions rebuilde l'image :
- À chaque push sur `main`
- Tous les jours à 4h (vérifie si `wordpress:latest` a changé)
- Manuellement via workflow_dispatch
