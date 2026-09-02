<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$error = SessionService::getFlash('error');
$success = SessionService::getFlash('success');

$pageTitle = 'Tableau de bord administrateur';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require dirname(__DIR__) . '/partials/head.php'; ?>

<body>
    <?php require dirname(__DIR__) . '/partials/header.php'; ?>

    <main class="container-fluid px-4 py-5">
        <div class="mb-4">
            <h1 class="h2 text-secondary mb-2">
                Tableau de bord administrateur
            </h1>

            <p class="text-muted mb-0">
                Gérez les utilisateurs, les agences et les trajets.
            </p>
        </div>

        <?php if ($error !== null): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </div>
        <?php endif; ?>

        <?php if ($success !== null): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars(
                    $success,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </div>
        <?php endif; ?>

        <section
            class="card border-0 shadow-sm mb-5"
            id="users"
        >
            <div class="card-header bg-secondary text-white py-3">
                <h2 class="h4 mb-0">
                    Utilisateurs
                </h2>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table
                        class="table table-striped table-hover
                               align-middle mb-0"
                    >
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Rôle</th>
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
                                        <span
                                            class="badge <?= $user['role'] === 'admin'
                                                ? 'text-bg-primary'
                                                : 'text-bg-secondary' ?>"
                                        >
                                            <?= htmlspecialchars(
                                                (string) $user['role'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section
            class="card border-0 shadow-sm mb-5"
            id="agencies"
        >
            <div
                class="card-header bg-secondary text-white
                       d-flex justify-content-between
                       align-items-center py-3"
            >
                <h2 class="h4 mb-0">
                    Agences
                </h2>

                <a
                    class="btn btn-light"
                    href="/admin/agencies/create"
                >
                    Ajouter une agence
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table
                        class="table table-striped table-hover
                               align-middle mb-0"
                    >
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom</th>
                                <th scope="col" class="text-end">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($agencies as $agency): ?>
                                <tr>
                                    <td>
                                        <?= (int) $agency['id'] ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            (string) $agency['name'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>

                                    <td>
                                        <div
                                            class="d-flex justify-content-end
                                                   gap-2"
                                        >
                                            <a
                                                class="btn btn-sm
                                                       btn-outline-secondary"
                                                href="/admin/agencies/<?= (int) $agency['id'] ?>/edit"
                                            >
                                                Modifier
                                            </a>

                                            <form
                                                action="/admin/agencies/<?= (int) $agency['id'] ?>/delete"
                                                method="post"
                                                onsubmit="return confirm(
                                                    'Supprimer cette agence ?'
                                                );"
                                            >
                                            <input
                                                type="hidden"
                                                name="csrf_token"
                                                value="<?= htmlspecialchars(
                                                    SessionService::getCsrfToken(),
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>"
                                            >
                                                <button
                                                    class="btn btn-sm
                                                           btn-outline-danger"
                                                    type="submit"
                                                >
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section
            class="card border-0 shadow-sm mb-4"
            id="trips"
        >
            <div class="card-header bg-secondary text-white py-3">
                <h2 class="h4 mb-0">
                    Trajets
                </h2>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table
                        class="table table-striped table-hover
                               align-middle mb-0"
                    >
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Départ</th>
                                <th scope="col">Arrivée</th>
                                <th scope="col">Date de départ</th>
                                <th scope="col">Utilisateur</th>
                                <th scope="col">Places</th>
                                <th scope="col" class="text-end">
                                    Actions
                                </th>
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
                                        <span class="badge text-bg-primary">
                                            <?= (int) $trip['available_seats'] ?>
                                            /
                                            <?= (int) $trip['total_seats'] ?>
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <form
                                            class="d-inline"
                                            action="/admin/trips/<?= (int) $trip['id'] ?>/delete"
                                            method="post"
                                            onsubmit="return confirm(
                                                'Supprimer ce trajet ?'
                                            );"
                                        >
                                        <input
                                            type="hidden"
                                            name="csrf_token"
                                            value="<?= htmlspecialchars(
                                                SessionService::getCsrfToken(),
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>"
                                        >
                                            <button
                                                class="btn btn-sm
                                                       btn-outline-danger"
                                                type="submit"
                                            >
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <a class="btn btn-outline-secondary" href="/">
            Retour à l'accueil
        </a>
    </main>

    <?php require dirname(__DIR__) . '/partials/footer.php'; ?>
</body>
</html>