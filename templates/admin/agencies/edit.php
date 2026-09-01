<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$error = SessionService::getFlash('error');

$pageTitle = 'Modifier une agence';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require dirname(__DIR__, 2) . '/partials/head.php'; ?>

<body>
    <?php require dirname(__DIR__, 2) . '/partials/header.php'; ?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="mb-4">
                    <h1 class="h2 text-secondary mb-2">
                        Modifier une agence
                    </h1>

                    <p class="text-muted mb-0">
                        Modifiez le nom de l'agence.
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
                    action="/admin/agencies/<?= (int) $agency['id'] ?>"
                    method="post"
                >
                    <div class="card-body p-4">
                        <label
                            class="form-label"
                            for="name"
                        >
                            Nom de l'agence
                        </label>

                        <input
                            class="form-control"
                            type="text"
                            id="name"
                            name="name"
                            value="<?= htmlspecialchars(
                                (string) $agency['name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                            required
                        >
                    </div>

                    <div
                        class="card-footer bg-white border-0
                               d-flex justify-content-end gap-2 p-4"
                    >
                        <a
                            class="btn btn-outline-secondary"
                            href="/admin#agencies"
                        >
                            Annuler
                        </a>

                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require dirname(__DIR__, 2) . '/partials/footer.php'; ?>
</body>
</html>