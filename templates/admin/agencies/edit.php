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
    <title>Modifier une agence - Touche pas au klaxon</title>
</head>

<body>
    <?php require dirname(__DIR__, 2) . '/partials/header.php'; ?>
    <main>
        <h1>Modifier une agence</h1>

        <?php if ($error !== null): ?>
            <p>
                <?= htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        <?php endif; ?>

        <form
            action="/admin/agencies/<?= (int) $agency['id'] ?>"
            method="post"
        >
            <div>
                <label for="name">
                    Nom de l'agence
                </label>

                <input
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

            <button type="submit">
                Enregistrer
            </button>
        </form>

        <a href="/admin">
            Annuler
        </a>
    </main>
    <?php require dirname(__DIR__, 2) . '/partials/footer.php'; ?>
</body>
</html>