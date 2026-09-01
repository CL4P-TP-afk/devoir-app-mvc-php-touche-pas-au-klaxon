<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Touche pas au klaxon</title>
</head>

<body>
    <main>
        <h1>Tableau de bord administrateur</h1>

        <section>
            <h2>Utilisateurs</h2>

            <p>
                Nombre d'utilisateurs : <?= count($users) ?>
            </p>
        </section>

        <section>
            <h2>Agences</h2>

            <p>
                Nombre d'agences : <?= count($agencies) ?>
            </p>
        </section>

        <section>
            <h2>Trajets</h2>

            <p>
                Nombre de trajets : <?= count($trips) ?>
            </p>
        </section>

        <a href="/">Retour à l'accueil</a>
    </main>
</body>
</html>