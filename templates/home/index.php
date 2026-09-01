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
                                            <button
                                                class="btn btn-primary"
                                                type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#tripModal<?= (int) $trip['id'] ?>"
                                            >
                                                Détails
                                            </button>

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
                        <div
                            class="modal fade"
                            id="tripModal<?= (int) $trip['id'] ?>"
                            tabindex="-1"
                            aria-labelledby="tripModalLabel<?= (int) $trip['id'] ?>"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary text-white">
                                        <h2
                                            class="modal-title fs-5"
                                            id="tripModalLabel<?= (int) $trip['id'] ?>"
                                        >
                                            Détails du trajet
                                        </h2>

                                        <button
                                            type="button"
                                            class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"
                                            aria-label="Fermer"
                                        ></button>
                                    </div>

                                    <div class="modal-body">
                                        <h3 class="h6 text-secondary">
                                            Trajet
                                        </h3>

                                        <p>
                                            <strong>Départ :</strong>
                                            <?= htmlspecialchars(
                                                (string) $trip['departure_agency'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </p>

                                        <p>
                                            <strong>Arrivée :</strong>
                                            <?= htmlspecialchars(
                                                (string) $trip['arrival_agency'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </p>

                                        <hr>

                                        <h3 class="h6 text-secondary">
                                            Proposé par
                                        </h3>

                                        <p>
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
                                            <strong>Téléphone :</strong>
                                            <?= htmlspecialchars(
                                                (string) $trip['contact_phone'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </p>

                                        <p>
                                            <strong>E-mail :</strong>
                                            <?= htmlspecialchars(
                                                (string) $trip['contact_email'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </p>

                                        <p class="mb-0">
                                            <strong>Nombre total de places :</strong>
                                            <?= (int) $trip['total_seats'] ?>
                                        </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Fermer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php require dirname(__DIR__) . '/partials/footer.php'; ?>
    <?php require dirname(__DIR__) . '/partials/scripts.php'; ?>
</body>
</html>