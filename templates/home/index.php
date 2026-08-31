<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$currentUser = SessionService::getUser();

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
                    <?php if ($currentUser !== null): ?>
                        <div>
                            <a href="/trips/<?= (int) $trip['id'] ?>">
                                Détails
                            </a>

                            <?php if ((int) $trip['user_id'] === SessionService::getUserId()): ?>
                                <a href="/trips/<?= (int) $trip['id'] ?>/edit">
                                    Modifier
                                </a>

                                <form
                                    action="/trips/<?= (int) $trip['id'] ?>/delete"
                                    method="post"
                                >
                                    <button type="submit">
                                        Supprimer
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>