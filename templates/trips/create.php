<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un trajet - Touche pas au klaxon</title>
</head>

<body>
    <main>
        <h1>Ajouter un trajet</h1>

        <p>
            Utilisateur :
            <?= htmlspecialchars(
                (string) $currentUser['first_name'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
            <?= htmlspecialchars(
                (string) $currentUser['last_name'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

        <p>
            Agences disponibles : <?= count($agencies) ?>
        </p>
    </main>
</body>
</html>