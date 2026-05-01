# wordpress

Image Docker WordPress personnalisée, basée sur `wordpress:latest` (Apache), avec :

- **WP-CLI** pré-installé (`wp` disponible dans le conteneur)
- **uploads.ini** configuré (500MB upload, 600s exec)
- **MU-plugin SMTP** — configure PHPMailer via env vars Docker (`SMTP_HOST`, `SMTP_USER`, `SMTP_PASS`, `SMTP_FROM`, `SMTP_FROM_NAME`)

## Image

```
ghcr.io/painteau/wordpress:latest
```

## Usage

Remplacer `wordpress:latest` par `ghcr.io/painteau/wordpress:latest` dans les docker-compose.

```yaml
services:
  wordpress:
    image: ghcr.io/painteau/wordpress:latest
    environment:
      SMTP_HOST: smtp.example.com
      SMTP_USER: user@example.com
      SMTP_PASS: motdepasse
      SMTP_FROM: noreply@example.com       # optionnel, défaut = SMTP_USER
      SMTP_FROM_NAME: Mon Site             # optionnel, défaut = nom du site WP
```

Le volume `uploads.ini` n'est plus nécessaire non plus.

## Build automatique

GitHub Actions rebuilde l'image :
- À chaque push sur `main`
- Tous les jours à 4h (vérifie si `wordpress:latest` a changé)
- Manuellement via workflow_dispatch
