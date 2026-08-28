# TOUCHE PAS AU KLAXON

Application intranet de covoiturage développée en PHP avec une architecture MVC.

L'application permet aux collaborateurs d'une entreprise de consulter et de proposer des trajets entre différentes agences.

## Technologies

- PHP 8.2
- MySQL / MariaDB
- Composer
- PHP-Dotenv
- izniburak/router
- PHPUnit
- PHPStan
- Bootstrap
- Sass

## Prérequis

- PHP 8.2 ou supérieur
- MySQL ou MariaDB
- Composer

## Installation

Cloner le dépôt :

```bash
git clone git@github.com:CL4P-TP-afk/devoir-app-mvc-php-touche-pas-au-klaxon.git
cd devoir-app-mvc-php-touche-pas-au-klaxon
```
Installer les dépendances PHP :

```bash
composer install
```

Créer le fichier d'environnement à partir de l'exemple :

```bash
cp .env.example .env
```

## Base de données
Créer la base de données et les tables à l'aide du fichier :
```
database/schema.sql
```
Insérer les données initiales à l'aide du fichier :
```
database/seed.sql
```
## Lancer l'application

Depuis la racine du projet :
```bash
php -S localhost:8000 -t public
```
L'application est ensuite accessible à l'adresse :
```
http://localhost:8000
```
## Tests

Lancer les tests automatisés :
```bash
composer test
```
## Analyse statique

Lancer PHPStan :
```bash
composer analyse
```
## Comptes de démonstration

Les identifiants de démonstration seront documentés à la fin du développement.

## Auteur

Loïc Fleury