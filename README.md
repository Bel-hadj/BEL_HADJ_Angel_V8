# Asians Dreams

Site web consacré à la pop culture asiatique : **K-Dramas**, **K-Pop** et **Mangas**.
Projet personnel réalisé et édité par Bel Hadj Angel.

## Présentation

Asians Dreams permet de découvrir une sélection de séries coréennes (K-Dramas), de
groupes et artistes K-Pop, ainsi que de mangas shonen, à travers des fiches
détaillées (résumé, informations, casting, bandes-annonces). Le site est
disponible en **français** et en **anglais** sur les sections K-Drama, K-Pop et
Mangas, chaque langue disposant de son propre contenu traduit.

## Fonctionnalités

- Page d'accueil présentant les trois univers du site avec accès direct à
  chacun d'eux.
- Fiches K-Drama : résumé, épisodes, casting, bande-annonce YouTube intégrée.
- Fiches K-Pop : présentation des groupes/artistes et actualités.
- Fiches Mangas : résumé, genre, nombre de tomes, note, prix.
- Bascule français / anglais indépendante sur chaque section (K-Drama, K-Pop,
  Mangas).
- Page À propos expliquant le concept du site et ses Conditions Générales
  d'Utilisation.
- Formulaire de contact avec validation côté serveur (nom, e-mail, message) et
  page de confirmation.
- Menu de navigation responsive avec menu mobile (hamburger).
- Design adapté du grand écran au smartphone.

## Technologies

- **PHP** 8.x
- **Twig** 3 (moteur de templates, via Composer)
- **HTML5 / CSS3** (variables CSS, Flexbox, media queries — sans framework)
- **JavaScript** natif (carrousel, menu mobile)
- Aucune base de données : le contenu (K-Dramas, K-Pop, Mangas) est stocké
  dans des fichiers PHP (`include/data_*.php`).

## Structure du projet

```
BEL_HADJ_Angel_V8/
├── accueil.php               # Contrôleurs PHP (un par page)
├── a_propos.php
├── contact.php
├── reception.php             # Traitement du formulaire de contact
├── kdrama.php / kdrama_en.php
├── kpop.php / kpop_en.php
├── mangas.php / mangas_en.php
├── include/
│   ├── twig.php               # Initialisation de Twig
│   └── data_*.php             # Données FR/EN des K-Dramas, K-Pop, Mangas
├── templates/                 # Vues Twig (.twig)
├── css/                       # Une feuille de style par section + style.css global
├── javascripts/               # carousel.js, nav.js
├── images/                    # Toutes les images du site
└── vendor/                    # Dépendances Composer (Twig)
```

## Installation locale (XAMPP)

1. Placer le dossier du projet dans `C:\xampp\htdocs\` (ex. `C:\xampp\htdocs\asians-dreams`).
2. Démarrer Apache depuis le panneau de contrôle XAMPP.
3. Les dépendances Composer (`vendor/`) sont déjà incluses dans le dépôt : aucune
   installation supplémentaire n'est nécessaire. Si vous préférez les
   régénérer vous-même :
   ```
   C:\xampp\php\php.exe C:\xampp\composer.phar install
   ```
4. Ouvrir le site dans un navigateur :
   ```
   http://localhost/asians-dreams/accueil.php
   ```

### Vérifier le code PHP

```
C:\xampp\php\php.exe -l accueil.php
```
(à répéter sur chaque fichier `.php`, ou via une boucle dans un terminal).

## Déploiement (Alwaysdata)

Le site est prêt pour un hébergement mutualisé Linux/PHP tel qu'Alwaysdata :

- Aucun chemin sensible à la casse (`Include/` vs `include/`) n'est utilisé.
- Le mode debug de Twig est automatiquement désactivé hors `localhost`
  (voir `include/twig.php`).
- `vendor/` est versionné, donc aucun accès SSH/Composer n'est requis sur
  l'hébergement : il suffit de déposer l'ensemble des fichiers via FTP/Git.
- Le site n'utilise aucune base de données. Si une base de données est
  ajoutée par la suite, les identifiants Alwaysdata ne doivent jamais être
  écrits en dur dans le code ni commités sur GitHub : utiliser un fichier
  `config.local.php` (ignoré par `.gitignore`) ou des variables
  d'environnement définies dans le panneau Alwaysdata.

## Captures d'écran

*(à ajouter : captures de la page d'accueil, d'une fiche K-Drama et de la
version mobile)*

## Démonstration

*(lien vers le site en ligne à ajouter une fois déployé sur Alwaysdata)*

## Portfolio

*(lien vers le portfolio à ajouter)*
