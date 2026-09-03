# TOUCHE PAS AU KLAXON

Application intranet de covoiturage développée en PHP selon une architecture MVC.

L'application permet aux collaborateurs d'une entreprise de consulter et de proposer des trajets entre différentes agences.

Les visiteurs peuvent consulter les trajets disponibles. Les utilisateurs authentifiés peuvent consulter les détails des trajets et gérer leurs propres trajets. Les administrateurs disposent d'une interface dédiée pour consulter les utilisateurs, gérer les agences et supprimer des trajets.

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

### Qualité

- PHPUnit 11
- PHPStan 2

## Prérequis

- Git
- PHP 8.2
- extensions PHP requises par l'application et ses dépendances, notamment `pdo_mysql`, `dom` et `xmlwriter`
- MySQL ou MariaDB
- Composer
- Node.js 20.19.0 ou supérieur
- npm

Les exigences PHP définies par les dépendances verrouillées peuvent être vérifiées avant l'installation :

```bash
composer check-platform-reqs --lock
```

Le `package-lock.json` actuel nécessite Node.js 20.19.0 ou supérieur.

## Installation

### 1. Cloner le dépôt

Avec HTTPS :

```bash
git clone https://github.com/CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon.git
cd devoir-app-mvc-php-touche-pas-au-klaxon
```

Ou avec SSH :

```bash
git clone git@github.com:CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon.git
cd devoir-app-mvc-php-touche-pas-au-klaxon
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances frontend

Le projet contient un `package-lock.json`. L'installation reproductible recommandée est :

```bash
npm ci
```

### 4. Compiler les assets

```bash
npm run build
```

Cette commande compile Sass et prépare le bundle JavaScript Bootstrap utilisé par l'application.

## Configuration

Créer un fichier `.env` à partir de `.env.example`.

Linux / macOS :

```bash
cp .env.example .env
```

Windows PowerShell :

```powershell
Copy-Item .env.example .env
```

Configurer ensuite la connexion MySQL / MariaDB :

```dotenv
DB_HOST=localhost
DB_PORT=3306
DB_NAME=touche_pas_au_klaxon
DB_USER=root
DB_PASSWORD=
```

Le fichier `.env` est propre à l'environnement local et n'est pas versionné.

## Base de données

Le projet utilise MySQL / MariaDB avec l'encodage `utf8mb4`.

Les scripts doivent être exécutés dans cet ordre sur une base fraîche :

1. `database/schema.sql`
2. `database/seed.sql`

`schema.sql` crée la base `touche_pas_au_klaxon` et ses tables. Le compte MySQL utilisé doit donc disposer du droit de créer une base de données.

`seed.sql` ajoute les agences, utilisateurs, comptes de démonstration et trajets nécessaires au fonctionnement et aux tests.

Le seed dépend des identifiants générés lors de son exécution. Le schéma et le seed ne sont donc pas conçus pour être réexécutés sur une base déjà initialisée.

### Import avec XAMPP / phpMyAdmin

Sous Windows :

1. ouvrir phpMyAdmin ;
2. ouvrir l'onglet **Importer** ;
3. importer `database/schema.sql` ;
4. importer ensuite `database/seed.sql`.

### Import avec le client MySQL

Sous Linux ou macOS :

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p < database/seed.sql
```

Adapter l'utilisateur MySQL si nécessaire.

## Lancer l'application

Depuis la racine du projet :

```bash
php -S localhost:8000 -t public public/router.php
```

L'application est accessible sur :

```text
http://localhost:8000
```

`public/index.php` est le front controller. `public/router.php` permet au serveur PHP intégré de servir les fichiers statiques et de transmettre les autres requêtes au routeur applicatif.

## Comptes de démonstration

### Utilisateur

```text
E-mail : alexandre.martin@email.fr
Mot de passe : Password123!
```

### Administrateur

```text
E-mail : admin@touchepasauklaxon.fr
Mot de passe : Password123!
```

Ces comptes sont créés par `database/seed.sql`. Les mots de passe sont stockés sous forme de hash.

## Fonctionnalités

### Visiteur

Un visiteur peut consulter les futurs trajets disposant encore de places ainsi que leurs agences, dates et horaires.

Les informations détaillées et les coordonnées des proposants ne sont pas rendues dans la page publique.

### Utilisateur authentifié

Un utilisateur peut :

- consulter le détail des trajets ;
- proposer un trajet ;
- modifier ses propres trajets ;
- supprimer ses propres trajets ;
- se déconnecter.

Les coordonnées associées aux trajets sont déterminées côté serveur à partir de données de confiance et ne peuvent pas être remplacées par des valeurs envoyées depuis le navigateur.

### Administrateur

Un administrateur peut :

- consulter les utilisateurs ;
- créer, modifier et supprimer les agences ;
- consulter les trajets ;
- supprimer les trajets.

La suppression d'une agence reste soumise aux contraintes d'intégrité de la base de données. L'administration des comptes utilisateurs n'est pas prévue par l'application.

## Sécurité

L'application met notamment en œuvre :

- le hashage et la vérification sécurisée des mots de passe ;
- l'authentification par session PHP ;
- des contrôles d'authentification, de rôle et de propriété côté serveur ;
- une protection CSRF sur les actions POST ;
- des requêtes préparées PDO avec émulation désactivée ;
- la validation serveur des données ;
- l'échappement des données affichées ;
- des contraintes d'intégrité SQL ;
- la protection des coordonnées des proposants contre la modification côté client et leur non-rendu pour les visiteurs.

## Tests

Lancer les tests PHPUnit :

```bash
composer test
```

La suite actuelle contient 7 tests portant principalement sur les opérations d'écriture en base des modèles `Agency` et `Trip`.

Les tests utilisent la base configurée dans `.env` et nécessitent les données du seed. Ils effectuent réellement des insertions, modifications et suppressions : ils ne doivent donc pas être exécutés sur une base contenant des données importantes.

Ils ne constituent pas des tests HTTP complets de l'ensemble de l'application.

## Analyse statique

Lancer PHPStan :

```bash
composer analyse
```

L'analyse porte sur le code PHP du dossier `src`.

## Développement frontend

Compiler les assets :

```bash
npm run build
```

Compiler Sass en continu pendant le développement :

```bash
npm run sass:watch
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

- `src/Model` : accès aux données ;
- `src/Controller` : traitement des actions ;
- `templates` : vues ;
- `src/Middleware` : authentification, autorisation et protection CSRF ;
- `src/Service` : services d'authentification et de session ;
- `public/index.php` : initialisation et déclaration des routes.

## Dépôt

GitHub :

```text
https://github.com/CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon
```

## Auteur

Loïc Fleury