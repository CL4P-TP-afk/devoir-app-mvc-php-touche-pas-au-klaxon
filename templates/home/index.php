<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$currentUser = SessionService::getUser();
$error = SessionService::getFlash('error');
$success = SessionService::getFlash('success');

$pageTitle = 'Accueil';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require dirname(__DIR__) . '/partials/head.php'; ?>

<body>
    <?php require dirname(__DIR__) . '/partials/header.php'; ?>

    <main class="container py-5">
        <div class="mb-4">
            <h1 class="h2 mb-2">Trajets disponibles</h1>

            <p class="text-muted mb-0">
                Retrouvez les prochains trajets disposant encore de places.
            </p>
        </div>

        <?php if ($error !== null): ?>
            <div
                class="alert alert-danger"
                role="alert"
            >
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if ($success !== null): ?>
            <div
                class="alert alert-success"
                role="alert"
            >
                <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if ($trips === []): ?>
            <div class="alert alert-light border" role="status">
                Aucun trajet disponible pour le moment.
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($trips as $trip): ?>
                    <div class="col-12">
                        <article class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                <div
                                    class="d-flex justify-content-between align-items-start gap-4"
                                >
                                    <div class="flex-grow-1">
                                        <h2 class="h4 text-secondary mb-3">
                                            <?= htmlspecialchars(
                                                (string) $trip['departure_agency'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>

                                            <span class="text-primary mx-2">
                                                →
                                            </span>

                                            <?= htmlspecialchars(
                                                (string) $trip['arrival_agency'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </h2>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <span
                                                    class="d-block small text-muted"
                                                >
                                                    Départ
                                                </span>

                                                <strong>
                                                    <?= htmlspecialchars(
                                                        (string) $trip['departure_date_time'],
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <span
                                                    class="d-block small text-muted"
                                                >
                                                    Arrivée
                                                </span>

                                                <strong>
                                                    <?= htmlspecialchars(
                                                        (string) $trip['arrival_date_time'],
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <span
                                                    class="d-block small text-muted"
                                                >
                                                    Places disponibles
                                                </span>

                                                <strong>
                                                    <?= (int) $trip['available_seats'] ?>
                                                    /
                                                    <?= (int) $trip['total_seats'] ?>
                                                </strong>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($currentUser !== null): ?>
                                        <div
                                            class="d-flex flex-column gap-2"
                                        >
                                            <a
                                                class="btn btn-primary"
                                                href="/trips/<?= (int) $trip['id'] ?>"
                                            >
                                                Détails
                                            </a>

                                            <?php if (
                                                (int) $trip['user_id']
                                                === SessionService::getUserId()
                                            ): ?>
                                                <a
                                                    class="btn btn-outline-secondary"
                                                    href="/trips/<?= (int) $trip['id'] ?>/edit"
                                                >
                                                    Modifier
                                                </a>

                                                <form
                                                    action="/trips/<?= (int) $trip['id'] ?>/delete"
                                                    method="post"
                                                    onsubmit="return confirm(
                                                        'Voulez-vous vraiment supprimer ce trajet ?'
                                                    );"
                                                >
                                                    <button
                                                        class="btn btn-outline-danger w-100"
                                                        type="submit"
                                                    >
                                                        Supprimer
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php require dirname(__DIR__) . '/partials/footer.php'; ?>
</body>
</html>