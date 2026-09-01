<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$error = SessionService::getFlash('error');
$pageTitle = 'Ajouter une agence';
?>

<!DOCTYPE html>
<html lang="fr">
<?php require dirname(__DIR__, 2) . '/partials/head.php'; ?>

<body>
    <?php require dirname(__DIR__, 2) . '/partials/header.php'; ?>
    <main>
        <h1>Ajouter une agence</h1>

        <?php if ($error !== null): ?>
            <p>
                <?= htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        <?php endif; ?>

        <form action="/admin/agencies" method="post">
            <div>
                <label for="name">
                    Nom de l'agence
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                >
            </div>

            <button type="submit">
                Ajouter
            </button>
        </form>

        <a href="/admin">
            Annuler
        </a>
    </main>
    <?php require dirname(__DIR__, 2) . '/partials/footer.php'; ?>
</body>
</html>