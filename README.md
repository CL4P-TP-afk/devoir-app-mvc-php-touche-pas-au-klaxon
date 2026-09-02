# TOUCHE PAS AU KLAXON

Application intranet de covoiturage développée en PHP avec une architecture MVC.

L'application permet aux collaborateurs d'une entreprise de consulter et de proposer des trajets entre différentes agences.

Les visiteurs peuvent consulter les trajets disponibles. Les utilisateurs authentifiés peuvent accéder aux informations détaillées des trajets et gérer leurs propres trajets. Les administrateurs disposent également d'une interface permettant de gérer les agences et les trajets.

## Technologies

### Backend

- PHP 8.2
- MySQL / MariaDB
- PDO
- Composer
- PHP-Dotenv
- izniburak/router

### Frontend

- Bootstrap 5
- Sass
- Node.js / npm

### Qualité du code

- PHPUnit
- PHPStan

## Prérequis

Avant d'installer le projet, vérifier que les outils suivants sont disponibles :

- PHP 8.2 ou supérieur
- MySQL ou MariaDB
- Composer
- Node.js et npm
- Git

## Installation

### 1. Cloner le dépôt

```bash
git clone git@github.com:CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon.git
cd devoir-app-mvc-php-touche-pas-au-klaxon
```

Dépôt GitHub :

https://github.com/CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances frontend

```bash
npm install
```

### 4. Compiler les assets

```bash
npm run build
```

Cette commande compile les fichiers Sass et prépare le bundle JavaScript Bootstrap utilisé par l'application.

## Configuration de l'environnement

Créer un fichier `.env` à partir du fichier `.env.example`.

Sous Linux/macOS :

```bash
cp .env.example .env
```

Sous Windows PowerShell :

```powershell
Copy-Item .env.example .env
```

Configurer ensuite les informations de connexion à la base de données dans `.env`.

Exemple :

```dotenv
DB_HOST=localhost
DB_PORT=3306
DB_NAME=touche_pas_au_klaxon
DB_USER=root
DB_PASSWORD=
```

Le fichier `.env` contient les paramètres propres à l'environnement local et ne doit pas être versionné.

## Base de données

Le projet utilise MySQL / MariaDB avec l'encodage `utf8mb4`.

### 1. Création de la base et des tables

Exécuter le fichier :

```text
database/schema.sql
```

Ce fichier crée la base de données `touche_pas_au_klaxon` ainsi que les tables nécessaires à l'application.

### 2. Données initiales

Exécuter ensuite :

```text
database/seed.sql
```

Le seed ajoute les agences, les utilisateurs de démonstration et plusieurs trajets permettant de tester l'application.

Les dates des trajets de démonstration sont calculées relativement à la date d'exécution du seed afin qu'ils restent disponibles pour les tests.

> Il est recommandé d'exécuter le seed sur une base fraîchement créée.

## Lancer l'application

Depuis la racine du projet :

```bash
php -S localhost:8000 -t public public/router.php
```

Le fichier `public/router.php` permet au serveur de développement PHP de servir les fichiers statiques tout en transmettant les routes de l'application au front controller.

L'application est ensuite accessible sur :

```text
http://localhost:8000
```

## Comptes de démonstration

### Utilisateur

```text
Email : alexandre.martin@email.fr
Mot de passe : Password123!
```

### Administrateur

```text
Email : admin@touchepasauklaxon.fr
Mot de passe : Password123!
```

Ces comptes sont créés par `database/seed.sql`.

## Fonctionnalités principales

- Consultation des futurs trajets disposant encore de places
- Authentification des collaborateurs
- Consultation des informations détaillées d'un trajet
- Création d'un trajet
- Modification de ses propres trajets
- Suppression de ses propres trajets
- Administration des agences
- Consultation des utilisateurs par l'administrateur
- Consultation et suppression des trajets par l'administrateur
- Messages flash après les opérations
- Protection CSRF des actions modifiant l'état de l'application
- Contrôle des autorisations côté serveur

## Tests

Lancer les tests automatisés PHPUnit :

```bash
composer test
```

Les tests couvrent notamment les opérations d'écriture en base de données sur les trajets et les agences.

## Analyse statique

Lancer PHPStan :

```bash
composer analyse
```

L'analyse permet de vérifier statiquement le code PHP et de détecter certaines incohérences avant l'exécution.

## Build frontend

Compiler les assets Bootstrap/Sass :

```bash
npm run build
```

Pendant le développement, Sass peut être lancé en mode surveillance :

```bash
npm run sass:watch
```

## Sécurité

L'application applique plusieurs protections côté serveur :

- mots de passe stockés sous forme de hash ;
- sessions PHP pour l'authentification ;
- régénération de l'identifiant de session après connexion ;
- contrôle des autorisations sur les routes protégées ;
- protection CSRF sur les actions modifiant l'état ;
- échappement des données dynamiques affichées dans les vues ;
- requêtes préparées PDO ;
- requêtes préparées natives MySQL ;
- validation des données reçues par le serveur ;
- données de contact des trajets protégées contre les modifications côté client.

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
```

L'application suit une architecture MVC :

- les **Models** assurent l'accès aux données ;
- les **Controllers** traitent les actions de l'application ;
- les **Views** sont stockées dans `templates/`;
- les **Middlewares** assurent notamment les contrôles d'authentification, d'autorisation et de sécurité ;
- les **Services** regroupent certaines responsabilités transversales comme la gestion des sessions et de l'authentification.

## Auteur

Loïc Fleury