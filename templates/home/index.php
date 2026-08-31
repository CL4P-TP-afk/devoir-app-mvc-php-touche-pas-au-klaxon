<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touche pas au klaxon</title>
</head>

<body>
    <main>
        <h1>Trajets disponibles</h1>

        <?php if ($trips === []): ?>
            <p>Aucun trajet disponible pour le moment.</p>
        <?php else: ?>
            <?php foreach ($trips as $trip): ?>
                <article>
                    <h2>
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
                    </h2>

                    <p>
                        Départ :
                        <?= htmlspecialchars(
                            (string) $trip['departure_date_time'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </p>

                    <p>
                        Arrivée :
                        <?= htmlspecialchars(
                            (string) $trip['arrival_date_time'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </p>

                    <p>
                        Places disponibles :
                        <?= (int) $trip['available_seats'] ?>
                        /
                        <?= (int) $trip['total_seats'] ?>
                    </p>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>