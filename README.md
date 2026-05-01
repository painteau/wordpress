# wordpress

Custom WordPress Docker image based on `wordpress:latest` (Apache), with:

- **WP-CLI** pre-installed (`wp` available in the container)
- **uploads.ini** configured (500MB upload, 600s execution time)
- **SMTP MU-plugin** — configures PHPMailer via Docker environment variables (`SMTP_HOST`, `SMTP_USER`, `SMTP_PASS`, `SMTP_FROM`, `SMTP_FROM_NAME`)

## Image

```
ghcr.io/painteau/wordpress:latest
```

## Usage

Replace `wordpress:latest` with `ghcr.io/painteau/wordpress:latest` in your docker-compose files.
No need for an `uploads.ini` volume anymore.

```yaml
services:
  wordpress:
    image: ghcr.io/painteau/wordpress:latest
    environment:
      SMTP_HOST: smtp.example.com
      SMTP_USER: user@example.com
      SMTP_PASS: password
      SMTP_PORT: 587                    # optional, defaults to 587 (465 = SSL)
      SMTP_FROM: noreply@example.com    # optional, defaults to SMTP_USER
      SMTP_FROM_NAME: My Site           # optional, defaults to WP site name
```

## Automatic builds

GitHub Actions rebuilds the image:
- On every push to `main`
- Daily at 4am (checks if `wordpress:latest` has changed upstream)
- Manually via `workflow_dispatch`
