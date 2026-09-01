<?php

declare(strict_types=1);

$pageTitle = 'Détail du trajet';
?>

<!DOCTYPE html>
<html lang="fr">
<?php require dirname(__DIR__) . '/partials/head.php'; ?>

<body>
    <?php require dirname(__DIR__) . '/partials/header.php'; ?>
    <main>
        <h1>
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
        </h1>

        <p>
            Conducteur :
            <?= htmlspecialchars(
                (string) $trip['first_name'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
            <?= htmlspecialchars(
                (string) $trip['last_name'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

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

        <p>
            Téléphone :
            <?= htmlspecialchars(
                (string) $trip['contact_phone'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

        <p>
            E-mail :
            <?= htmlspecialchars(
                (string) $trip['contact_email'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

        <a href="/">Retour aux trajets</a>
    </main>
    <?php require dirname(__DIR__) . '/partials/footer.php'; ?>
</body>
</html>