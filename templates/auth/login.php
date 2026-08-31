<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$error = SessionService::getFlash('error');

if (SessionService::isAuthenticated()) {
    header('Location: /');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Touche pas au klaxon</title>
</head>

<body>
    <main>
        <h1>Connexion</h1>

        <?php if ($error !== null): ?>
            <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form action="/login" method="post">
            <div>
                <label for="email">Adresse e-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                >
            </div>

            <div>
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </main>
</body>
</html>