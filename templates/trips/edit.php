<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un trajet - Touche pas au klaxon</title>
</head>

<body>
    <main>
        <h1>Modifier le trajet</h1>

        <p>
            <?= htmlspecialchars(
                (string) $trip['departure_agency'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
            →
            <?= htmlspecialchars(
                (string) $trip['arrival_agency'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

        <p>Agences disponibles : <?= count($agencies) ?></p>

        <a href="/">Annuler</a>
    </main>
</body>
</html>