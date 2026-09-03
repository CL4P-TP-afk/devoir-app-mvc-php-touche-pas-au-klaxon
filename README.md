# TOUCHE PAS AU KLAXON

Application intranet de covoiturage développée en PHP selon une architecture MVC.

L'application permet aux collaborateurs d'une entreprise de consulter et de proposer des trajets entre différentes agences.

Les visiteurs peuvent consulter les trajets disponibles. Les utilisateurs authentifiés peuvent consulter les informations détaillées des trajets et gérer leurs propres trajets. Les administrateurs disposent d'une interface dédiée permettant de consulter les utilisateurs, gérer les agences et supprimer des trajets.

## Technologies

### Backend

- PHP 8.2
- MySQL / MariaDB
- PDO avec le pilote MySQL
- Composer
- PHP-Dotenv
- izniburak/router

### Frontend

- Bootstrap 5
- Sass
- Node.js / npm

### Qualité du code

- PHPUnit 11
- PHPStan 2

## Prérequis

Avant d'installer le projet, vérifier que les outils suivants sont disponibles :

- Git
- PHP 8.2
- PHP 8.2
- extensions PHP requises par l'application et ses dépendances, notamment `pdo_mysql`, `dom` et `xmlwriter`
- MySQL ou MariaDB
- Composer
- Node.js 20.19.0 ou supérieur
- npm

Pour vérifier les extensions PHP disponibles :

```bash
php -m
```

La liste doit notamment contenir :

```text
PDO
pdo_mysql
```

Après l'installation des dépendances PHP, les exigences de la plateforme peuvent également être vérifiées avec :

```bash
composer check-platform-reqs
```

Le `package-lock.json` actuel nécessite Node.js 20.19.0 ou supérieur.

## Installation

### 1. Cloner le dépôt

Avec HTTPS :

```bash
git clone https://github.com/CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon.git
cd devoir-app-mvc-php-touche-pas-au-klaxon
```

Avec SSH si une clé GitHub est configurée :

```bash
git clone git@github.com:CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon.git
cd devoir-app-mvc-php-touche-pas-au-klaxon
```

Dépôt GitHub :

```text
https://github.com/CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon
```

### 2. Installer les dépendances PHP

```bash
composer check-platform-reqs --lock
```
Cette commande permet de vérifier que la version de PHP et les extensions
requises par les dépendances verrouillées sont disponibles.

```bash
composer install
```

### 3. Installer les dépendances frontend

Le projet contient un fichier `package-lock.json`.

Pour une installation reproductible :

```bash
npm ci
```

Si nécessaire, il est également possible d'utiliser :

```bash
npm install
```

### 4. Compiler les assets

```bash
npm run build
```

Cette commande :

- compile les fichiers Sass vers `public/assets/css/main.css` ;
- copie le bundle JavaScript Bootstrap vers `public/assets/js/bootstrap.bundle.min.js`.

## Configuration

Créer un fichier `.env` à partir de `.env.example`.

Sous Linux ou macOS :

```bash
cp .env.example .env
```

Sous Windows PowerShell :

```powershell
Copy-Item .env.example .env
```

Configurer ensuite les informations de connexion à MySQL ou MariaDB.

Exemple :

```dotenv
DB_HOST=localhost
DB_PORT=3306
DB_NAME=touche_pas_au_klaxon
DB_USER=root
DB_PASSWORD=
```

Le fichier `.env` contient des informations propres à l'environnement local. Il est ignoré par Git et ne doit pas être versionné.

## Base de données

Le projet utilise MySQL / MariaDB avec l'encodage `utf8mb4`.

Les scripts doivent être exécutés dans l'ordre suivant :

1. `database/schema.sql`
2. `database/seed.sql`

Il est recommandé de les exécuter sur une base vide.

Le fichier `schema.sql` crée la base de données `touche_pas_au_klaxon` ainsi que les tables nécessaires à l'application.

Le fichier `seed.sql` ajoute les données de démonstration utilisées par l'application et les tests.

### Import sous Windows avec XAMPP

La méthode recommandée est d'utiliser phpMyAdmin :

1. ouvrir phpMyAdmin ;
2. utiliser l'onglet **Importer** ;
3. importer `database/schema.sql` ;
4. importer ensuite `database/seed.sql`.

### Import avec le client MySQL sous Linux ou macOS

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p < database/seed.sql
```

Adapter l'utilisateur MySQL si nécessaire.

Le compte SQL utilisé pour `schema.sql` doit disposer du droit de créer une base de données.

### Données initiales

Le seed ajoute notamment :

- les agences ;
- les utilisateurs de démonstration ;
- un compte administrateur ;
- plusieurs trajets de démonstration.

Les trajets du seed utilisent les identifiants générés lors de l'insertion des utilisateurs et agences. Il est donc important d'exécuter le seed sur une base fraîchement créée.

Le schéma et le seed ne sont pas conçus pour être réexécutés plusieurs fois sur une base déjà initialisée.

## Lancer l'application

Depuis la racine du projet :

```bash
php -S localhost:8000 -t public public/router.php
```

L'application est ensuite accessible à l'adresse :

```text
http://localhost:8000
```

`public/index.php` constitue le front controller de l'application.

`public/router.php` permet au serveur PHP intégré de servir directement les fichiers statiques et de transmettre les autres requêtes au routeur applicatif.

Cette commande est destinée au développement local.

## Comptes de démonstration

### Utilisateur standard

```text
E-mail : alexandre.martin@email.fr
Mot de passe : Password123!
```

### Administrateur

```text
E-mail : admin@touchepasauklaxon.fr
Mot de passe : Password123!
```

Ces comptes sont créés par `database/seed.sql`.

Les mots de passe sont stockés sous forme de hash et vérifiés avec `password_verify`.

## Fonctionnalités

### Visiteur

Un visiteur non authentifié peut :

- consulter les futurs trajets disponibles ;
- voir les agences de départ et d'arrivée ;
- consulter les dates et heures ;
- consulter le nombre de places disponibles ;
- accéder à la page de connexion.

Les informations détaillées et les coordonnées des proposants ne sont pas rendues dans la page publique.

### Utilisateur authentifié

Un utilisateur authentifié peut :

- consulter les informations détaillées d'un trajet ;
- proposer un trajet ;
- modifier ses propres trajets ;
- supprimer ses propres trajets ;
- se déconnecter.

Lors de la création d'un trajet, les coordonnées de contact sont récupérées depuis l'utilisateur authentifié côté serveur.

Lors d'une modification, les coordonnées déjà enregistrées avec le trajet sont conservées.

Les valeurs envoyées depuis le navigateur ne sont donc pas utilisées comme source de confiance pour modifier ces informations.

### Administrateur

Un administrateur peut :

- consulter la liste des utilisateurs ;
- consulter les agences ;
- créer une agence ;
- modifier une agence ;
- supprimer une agence lorsque les contraintes de la base le permettent ;
- consulter les trajets ;
- supprimer un trajet.

L'interface d'administration ne permet pas de créer ou modifier les utilisateurs.

## Sécurité

Plusieurs protections sont mises en œuvre côté serveur :

- authentification par adresse électronique et mot de passe ;
- mots de passe stockés sous forme de hash ;
- vérification avec `password_verify` ;
- gestion de l'authentification avec les sessions PHP ;
- régénération de l'identifiant de session après connexion ;
- suppression de la session lors de la déconnexion ;
- contrôle de l'authentification sur les routes protégées ;
- contrôle du rôle administrateur sur les routes d'administration ;
- contrôle de propriété avant modification ou suppression d'un trajet ;
- protection CSRF des actions POST ;
- génération du token CSRF avec `random_bytes` ;
- comparaison sécurisée avec `hash_equals` ;
- requêtes préparées PDO ;
- désactivation de l'émulation des requêtes préparées avec `PDO::ATTR_EMULATE_PREPARES => false` ;
- validation serveur des données de trajet ;
- contraintes SQL sur les données ;
- échappement avec `htmlspecialchars` des données affichées provenant des utilisateurs ou de la base ;
- protection des coordonnées des trajets contre les modifications provenant du client ;
- non-rendu des coordonnées des proposants pour les visiteurs non authentifiés.

## Tests

Les tests automatisés sont exécutés avec PHPUnit :

```bash
composer test
```

La couverture actuelle comprend notamment :

- création d'une agence ;
- modification d'une agence ;
- suppression d'une agence ;
- création d'un trajet ;
- modification d'un trajet ;
- suppression d'un trajet ;
- test minimal de fonctionnement de PHPUnit.

Les tests portent principalement sur les opérations d'écriture des modèles `Agency` et `Trip`.

Ils ne constituent pas des tests HTTP complets et ne couvrent pas automatiquement l'ensemble des contrôleurs, vues, autorisations ou protections CSRF.

### Base utilisée par les tests

Les tests utilisent actuellement la base configurée dans le fichier `.env`.

Ils effectuent réellement des opérations d'insertion, de modification et de suppression.

Il est donc recommandé de ne pas exécuter les tests sur une base contenant des données importantes.

Les tests de trajets utilisent également certaines données présentes dans le seed. La base doit donc avoir été initialisée avec :

```text
database/schema.sql
database/seed.sql
```

avant l'exécution des tests.

## Analyse statique

Lancer PHPStan avec :

```bash
composer analyse
```

La configuration actuelle analyse le code PHP du dossier `src`.

## Développement frontend

Compiler l'ensemble des assets :

```bash
npm run build
```

Compiler uniquement Sass :

```bash
npm run sass
```

Lancer Sass en mode surveillance :

```bash
npm run sass:watch
```

Reconstruire uniquement le bundle JavaScript Bootstrap :

```bash
npm run build:js
```

## Structure du projet

```text
database/
├── schema.sql
└── seed.sql

public/
├── index.php
├── router.php
└── assets/
    ├── css/
    ├── js/
    └── scss/

src/
├── Controller/
├── Middleware/
├── Model/
└── Service/

templates/
├── admin/
├── auth/
├── home/
├── partials/
└── trips/

tests/
├── AgencyTest.php
├── SmokeTest.php
└── TripTest.php
```

L'application suit une architecture MVC :

- les modèles de `src/Model` assurent l'accès aux données ;
- les contrôleurs de `src/Controller` traitent les actions de l'application ;
- les vues sont stockées dans `templates` ;
- les middlewares assurent les contrôles d'authentification, d'autorisation et la protection CSRF ;
- les services regroupent notamment la gestion des sessions et de l'authentification ;
- `public/index.php` initialise l'application et déclare les routes.

## Auteur

Loïc Fleury