# Asian Dreams

Site bilingue (français / anglais) consacré à la pop culture asiatique : **K-Dramas**, **K-Pop** et **mangas**. Chaque rubrique présente des fiches détaillées avec affiches, informations clés et, pour les K-Dramas, la bande-annonce.

> Projet personnel réalisé en PHP et Twig, repris et amélioré pour mon portfolio.

- Démonstration : _lien à ajouter après la mise en ligne_
- Portfolio : _lien à ajouter_

## Captures d'écran

_À ajouter dans `docs/` puis à référencer ici :_

| Accueil | K-Drama | Mobile |
| --- | --- | --- |
| _capture_ | _capture_ | _capture_ |

## Fonctionnalités

- Page d'accueil qui présente le concept et donne accès aux trois univers.
- Rubriques **K-Drama**, **K-Pop** et **Mangas** : fiches, plan de page avec section active, vidéos YouTube en mode sans cookies.
- **Bilingue FR / EN** sur toutes les pages : le lien de changement de langue mène toujours à la page équivalente, et la navigation reste dans la langue choisie.
- Formulaire de contact avec validation côté serveur, jeton CSRF, champ anti-robots et message de confirmation. Aucun e-mail n'est envoyé : les messages sont enregistrés dans `storage/messages.jsonl` (non publié sur Git, inaccessible depuis le web).
- Galerie d'images accessible (boutons, pause, respect de `prefers-reduced-motion`).
- Design responsive (grand écran, portable, tablette, smartphone) avec menu mobile accessible.
- Accessibilité : lien d'évitement, titres hiérarchisés, `alt` descriptifs, labels de formulaire, navigation au clavier, `aria-current`.
- SEO : `title` et `meta description` uniques par page, `lang` correct, favicon.

## Technologies

- PHP 8 (compatible 8.0 et plus)
- [Twig](https://twig.symfony.com/) 3 (dépendance Composer, dossier `vendor/` versionné pour simplifier l'hébergement)
- HTML5, CSS3 (variables, Grid, Flexbox), JavaScript sans dépendance

## Structure du projet

```
├── accueil.php, kdrama.php, kpop.php, mangas.php,
│   a_propos.php, contact.php      Contrôleurs (version française)
├── *_en.php                       Versions anglaises (même contrôleur, langue forcée)
├── reception.php                  Traitement du formulaire de contact
├── include/
│   ├── config.php                 Environnement (local / production), erreurs PHP
│   ├── twig.php                   Initialisation de Twig, table des pages, rendu
│   ├── i18n.php                   Textes de l'interface en FR et EN
│   ├── contact.php                Validation, CSRF, enregistrement des messages
│   └── data_*.php                 Contenus des fiches (FR et EN)
├── templates/                     Modèles Twig (base, pages, parties réutilisables)
├── css/style.css                  Feuille de style unique
├── js/main.js                     Menu mobile, galerie, plan de page
├── images/                        Affiches, couvertures, portraits, drapeaux
├── storage/                       Messages du formulaire (ignoré par Git)
└── vendor/                        Dépendances Composer (Twig)
```

Pour ajouter une page, déclarez-la dans `SITE_PAGES` (`include/twig.php`), ajoutez ses textes dans `include/i18n.php` et créez le contrôleur et le template correspondants.

## Installation locale avec XAMPP

1. Installer [XAMPP](https://www.apachefriends.org/) (PHP 8.0 ou plus).
2. Placer le dossier du projet dans `C:\xampp\htdocs\`.
3. Démarrer **Apache** depuis le panneau XAMPP.
4. Ouvrir <http://localhost/BEL_HADJ_Angel_V8/accueil.php>.

En local (`localhost`), PHP affiche les erreurs et Twig est en mode debug. Sans XAMPP, on peut aussi lancer `php -S localhost:8080` à la racine du projet.

Les dépendances sont déjà dans `vendor/`. Pour les mettre à jour : `composer update`.

## Déploiement sur Alwaysdata (Linux / PHP)

1. Envoyer le contenu du projet dans le dossier `www` du compte (SFTP ou Git), `vendor/` compris.
2. Dans l'administration Alwaysdata, choisir PHP 8.x pour le site.
3. Vérifier que `storage/` et `cache/` sont accessibles en écriture (`chmod 775`). `cache/twig` est créé automatiquement en production.
4. Le fichier `.htaccess` interdit l'accès direct à `include/`, `templates/`, `vendor/` et `storage/`.
5. Le mode production est détecté automatiquement (hôte différent de `localhost`). Il peut être forcé avec la variable d'environnement `APP_ENV=prod` (ou `dev`).

Les noms de fichiers respectent la casse exacte, comme l'exige Linux.

### Secrets

Le site n'utilise actuellement **aucune base de données** ni aucun mot de passe. Si un jour des identifiants sont nécessaires (base de données, service d'e-mail…), ne les écrivez jamais dans le code :

- soit des variables d'environnement (à définir dans l'administration Alwaysdata) lues avec `getenv()` ;
- soit le fichier `include/config.local.php`, chargé automatiquement s'il existe et **ignoré par Git** (voir `.gitignore`).

## Contenus et droits

Les affiches, couvertures et portraits appartiennent à leurs ayants droit et sont utilisés à titre illustratif. Les articles de la rubrique K-Pop résument des actualités de presse : ajoutez vos sources ou remplacez-les par des textes personnels avant une mise en ligne publique.

## Auteur

Angel Bel Hadj
