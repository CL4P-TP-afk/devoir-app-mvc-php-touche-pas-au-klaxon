<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$error = SessionService::getFlash('error');

$pageTitle = 'Ajouter un trajet';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require dirname(__DIR__) . '/partials/head.php'; ?>

<body>
    <?php require dirname(__DIR__) . '/partials/header.php'; ?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-9">
                <div class="mb-4">
                    <h1 class="h2 text-secondary mb-2">
                        Ajouter un trajet
                    </h1>

                    <p class="text-muted mb-0">
                        Renseignez les informations du trajet proposé.
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

                <form
                    class="card border-0 shadow-sm"
                    action="/trips"
                    method="post"
                >
                    <div class="card-body p-4">
                        <h2 class="h5 text-secondary mb-3">
                            Itinéraire
                        </h2>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label
                                    class="form-label"
                                    for="departure_agency_id"
                                >
                                    Agence de départ
                                </label>

                                <select
                                    class="form-select"
                                    id="departure_agency_id"
                                    name="departure_agency_id"
                                    required
                                >
                                    <option value="">
                                        Sélectionner une agence
                                    </option>

                                    <?php foreach ($agencies as $agency): ?>
                                        <option
                                            value="<?= (int) $agency['id'] ?>"
                                        >
                                            <?= htmlspecialchars(
                                                (string) $agency['name'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label
                                    class="form-label"
                                    for="arrival_agency_id"
                                >
                                    Agence d'arrivée
                                </label>

                                <select
                                    class="form-select"
                                    id="arrival_agency_id"
                                    name="arrival_agency_id"
                                    required
                                >
                                    <option value="">
                                        Sélectionner une agence
                                    </option>

                                    <?php foreach ($agencies as $agency): ?>
                                        <option
                                            value="<?= (int) $agency['id'] ?>"
                                        >
                                            <?= htmlspecialchars(
                                                (string) $agency['name'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label
                                    class="form-label"
                                    for="departure_date_time"
                                >
                                    Date et heure de départ
                                </label>

                                <input
                                    class="form-control"
                                    type="datetime-local"
                                    id="departure_date_time"
                                    name="departure_date_time"
                                    required
                                >
                            </div>

                            <div class="col-md-6">
                                <label
                                    class="form-label"
                                    for="arrival_date_time"
                                >
                                    Date et heure d'arrivée
                                </label>

                                <input
                                    class="form-control"
                                    type="datetime-local"
                                    id="arrival_date_time"
                                    name="arrival_date_time"
                                    required
                                >
                            </div>
                        </div>

                        <h2 class="h5 text-secondary mb-3">
                            Places
                        </h2>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label
                                    class="form-label"
                                    for="total_seats"
                                >
                                    Nombre total de places
                                </label>

                                <input
                                    class="form-control"
                                    type="number"
                                    id="total_seats"
                                    name="total_seats"
                                    min="1"
                                    required
                                >
                            </div>

                            <div class="col-md-6">
                                <label
                                    class="form-label"
                                    for="available_seats"
                                >
                                    Places disponibles
                                </label>

                                <input
                                    class="form-control"
                                    type="number"
                                    id="available_seats"
                                    name="available_seats"
                                    min="0"
                                    required
                                >
                            </div>
                        </div>

                        <h2 class="h5 text-secondary mb-3">
                            Coordonnées
                        </h2>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label
                                    class="form-label"
                                    for="contact_phone"
                                >
                                    Téléphone
                                </label>

                                <input
                                    class="form-control"
                                    type="tel"
                                    id="contact_phone"
                                    name="contact_phone"
                                    value="<?= htmlspecialchars(
                                        (string) $currentUser['phone'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>"
                                    readonly
                                >
                            </div>

                            <div class="col-md-6">
                                <label
                                    class="form-label"
                                    for="contact_email"
                                >
                                    E-mail
                                </label>

                                <input
                                    class="form-control"
                                    type="email"
                                    id="contact_email"
                                    name="contact_email"
                                    value="<?= htmlspecialchars(
                                        (string) $currentUser['email'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>"
                                    readonly
                                >
                            </div>
                        </div>
                    </div>

                    <div
                        class="card-footer bg-white border-0
                               d-flex justify-content-end gap-2 p-4"
                    >
                        <a class="btn btn-outline-secondary" href="/">
                            Annuler
                        </a>

                        <button class="btn btn-primary" type="submit">
                            Ajouter le trajet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require dirname(__DIR__) . '/partials/footer.php'; ?>
</body>
</html>