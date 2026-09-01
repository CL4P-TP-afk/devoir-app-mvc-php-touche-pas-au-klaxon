<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$error = SessionService::getFlash('error');
$success = SessionService::getFlash('success');
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

        <?php if ($error !== null): ?>
            <p>
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <?php if ($success !== null): ?>
            <p>
                <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <section id="users">
            <h2>Utilisateurs</h2>

            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars(
                                    (string) $user['first_name'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                                <?= htmlspecialchars(
                                    (string) $user['last_name'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $user['email'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $user['phone'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $user['role'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section id="agencies">
            <h2>Agences</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($agencies as $agency): ?>
                        <tr>
                            <td><?= (int) $agency['id'] ?></td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $agency['name'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <a
                                    href="/admin/agencies/<?= (int) $agency['id'] ?>/edit"
                                >
                                    Modifier
                                </a>

                                <form
                                    action="/admin/agencies/<?= (int) $agency['id'] ?>/delete"
                                    method="post"
                                >
                                    <button type="submit">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a href="/admin/agencies/create">
                Ajouter une agence
            </a>
        </section>

        <section id="trips">
            <h2>Trajets</h2>

            <table>
                <thead>
                    <tr>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Date de départ</th>
                        <th>Utilisateur</th>
                        <th>Places</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($trips as $trip): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars(
                                    (string) $trip['departure_agency'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $trip['arrival_agency'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $trip['departure_date_time'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
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
                            </td>

                            <td>
                                <?= (int) $trip['available_seats'] ?>
                                /
                                <?= (int) $trip['total_seats'] ?>
                            </td>

                            <td>
                                <form
                                    action="/admin/trips/<?= (int) $trip['id'] ?>/delete"
                                    method="post"
                                >
                                    <button type="submit">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <a href="/">
            Retour à l'accueil
        </a>
    </main>
</body>
</html>