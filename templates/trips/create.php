<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$error = SessionService::getFlash('error');
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

        <?php if ($error !== null): ?>
            <p>
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <form action="/trips" method="post">
            <div>
                <label for="departure_agency_id">
                    Agence de départ
                </label>

                <select
                    id="departure_agency_id"
                    name="departure_agency_id"
                    required
                >
                    <option value="">
                        Sélectionner une agence
                    </option>

                    <?php foreach ($agencies as $agency): ?>
                        <option value="<?= (int) $agency['id'] ?>">
                            <?= htmlspecialchars(
                                (string) $agency['name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="arrival_agency_id">
                    Agence d'arrivée
                </label>

                <select
                    id="arrival_agency_id"
                    name="arrival_agency_id"
                    required
                >
                    <option value="">
                        Sélectionner une agence
                    </option>

                    <?php foreach ($agencies as $agency): ?>
                        <option value="<?= (int) $agency['id'] ?>">
                            <?= htmlspecialchars(
                                (string) $agency['name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="departure_date_time">
                    Date et heure de départ
                </label>

                <input
                    type="datetime-local"
                    id="departure_date_time"
                    name="departure_date_time"
                    required
                >
            </div>

            <div>
                <label for="arrival_date_time">
                    Date et heure d'arrivée
                </label>

                <input
                    type="datetime-local"
                    id="arrival_date_time"
                    name="arrival_date_time"
                    required
                >
            </div>

            <div>
                <label for="total_seats">
                    Nombre total de places
                </label>

                <input
                    type="number"
                    id="total_seats"
                    name="total_seats"
                    min="1"
                    required
                >
            </div>

            <div>
                <label for="available_seats">
                    Places disponibles
                </label>

                <input
                    type="number"
                    id="available_seats"
                    name="available_seats"
                    min="0"
                    required
                >
            </div>

            <div>
                <label for="contact_phone">
                    Téléphone
                </label>

                <input
                    type="tel"
                    id="contact_phone"
                    name="contact_phone"
                    value="<?= htmlspecialchars(
                        (string) $currentUser['phone'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    required
                >
            </div>

            <div>
                <label for="contact_email">
                    E-mail
                </label>

                <input
                    type="email"
                    id="contact_email"
                    name="contact_email"
                    value="<?= htmlspecialchars(
                        (string) $currentUser['email'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    required
                >
            </div>

            <button type="submit">
                Ajouter le trajet
            </button>

            <a href="/">
                Annuler
            </a>
        </form>
    </main>
</body>
</html>