<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$error = SessionService::getFlash('error');

if (SessionService::isAuthenticated()) {
    header('Location: /');
    exit;
}

$pageTitle = 'Connexion';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require dirname(__DIR__) . '/partials/head.php'; ?>

<body>
    <?php require dirname(__DIR__) . '/partials/header.php'; ?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                <section class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <div class="mb-4">
                            <h1 class="h2 text-secondary mb-2">
                                Connexion
                            </h1>

                            <p class="text-muted mb-0">
                                Connectez-vous pour accéder aux fonctionnalités
                                de l'application.
                            </p>
                        </div>

                        <?php if ($error !== null): ?>
                            <div
                                class="alert alert-danger"
                                role="alert"
                            >
                                <?= htmlspecialchars(
                                    $error,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </div>
                        <?php endif; ?>

                        <form action="/login" method="post">
                            <div class="mb-3">
                                <label
                                    class="form-label"
                                    for="email"
                                >
                                    Adresse e-mail
                                </label>

                                <input
                                    class="form-control"
                                    type="email"
                                    id="email"
                                    name="email"
                                    autocomplete="email"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label
                                    class="form-label"
                                    for="password"
                                >
                                    Mot de passe
                                </label>

                                <input
                                    class="form-control"
                                    type="password"
                                    id="password"
                                    name="password"
                                    autocomplete="current-password"
                                    required
                                >
                            </div>

                            <button
                                class="btn btn-primary w-100"
                                type="submit"
                            >
                                Se connecter
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <?php require dirname(__DIR__) . '/partials/footer.php'; ?>
</body>
</html>