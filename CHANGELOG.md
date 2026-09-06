# Changelog

Toutes les évolutions notables de `wordpress` sont documentées ici.

Format inspiré de [Keep a Changelog](https://keepachangelog.com/fr/1.1.0/), versionnage
[SemVer](https://semver.org/lang/fr/). La section `[Unreleased]` accumule au fil de l'eau et
est renommée en numéro de version au moment de poser le tag.

Ce fichier est créé le 2026-09-05, après la mise en service : les évolutions antérieures ne sont
pas reconstituées, ce qui serait de la réécriture d'historique plutôt que de la documentation.
L'historique git reste la source de vérité pour ce qui précède.

## [Unreleased]

### Ajouté

- **Licence BZ-1.1 sur le `Dockerfile` et la configuration**, avec une portée écrite en
  tête du fichier. Ce dépôt était public sans aucune licence, ce que la convention du
  parc interdit. Un Dockerfile n'est pas une œuvre dérivée de l'image qu'il construit :
  c'est une recette, pas du code lié, donc rien n'est repris de l'image `wordpress`
  officielle.
- **`mu-plugins/disable-updates.php` et `mu-plugins/smtp.php` marqués GPLv2 ou
  ultérieure** (en-tête SPDX), et exclus nommément de la licence du dépôt. Ce sont des
  extensions WordPress : elles appellent les API de WordPress, et du PHP qui fait cela est
  tenu par la position dominante de l'écosystème pour une œuvre dérivée de WordPress,
  donc redevable d'une licence compatible GPL — ce que BZ-1.1 n'est pas. La position ne
  s'est jamais tranchée en justice et se conteste, mais sur un dépôt public ce n'est pas
  le pari à prendre, et l'exclusion coûte deux commentaires.


## [0.1.0] - 2026-09-05

### Modifié

- **Le déploiement ne part plus sur un push de branche, mais sur un tag `vX.Y.Z`.** Pousser un
  correctif de documentation ou une expérimentation sur `main` déclenchait jusqu'ici une livraison
  en production, ce qui va contre la règle du parc et rend toute modification du dépôt risquée.
  `workflow_dispatch` est conservé comme filet, ainsi que les crons de reconstruction et les
  déclencheurs de `pull_request`, qui sont des vérifications et non des livraisons.
- Volontairement **sans filtre de chemin** : GitHub combine (branches/tags) ET `paths`, ce qui rend
  un déclencheur sur tag imprévisible dès qu'un filtre de chemin subsiste.

### Ajouté

- **Convention changelog du parc posée sur ce dépôt** : ce fichier, les hooks `pre-commit` et
  `pre-push` dans `.githooks/`, et le workflow `changelog-guard.yml` qui rejoue les mêmes
  contrôles en CI au moment du tag. Ce dépôt en était dépourvu alors qu'il est déployé, ce qui
  le laissait hors de la garantie que les autres ont.

