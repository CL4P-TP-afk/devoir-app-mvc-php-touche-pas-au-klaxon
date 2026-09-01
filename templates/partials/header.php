<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$currentUser = SessionService::getUser();
$isAuthenticated = SessionService::isAuthenticated();
$isAdmin = SessionService::isAdmin();

$homeUrl = $isAdmin ? '/admin' : '/';
?>

<header>
    <nav>
        <a href="<?= $homeUrl ?>">
            Touche pas au klaxon
        </a>

        <?php if (!$isAuthenticated): ?>
            <a href="/login">
                Connexion
            </a>

        <?php elseif ($isAdmin): ?>
            <a href="/admin#users">
                Utilisateurs
            </a>

            <a href="/admin#agencies">
                Agences
            </a>

            <a href="/admin#trips">
                Trajets
            </a>

            <a href="/logout">
                Déconnexion
            </a>

        <?php else: ?>
            <a href="/trips/create">
                Proposer un trajet
            </a>

            <?php if ($currentUser !== null): ?>
                <span>
                    <?= htmlspecialchars(
                        (string) $currentUser['first_name'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                    <?= htmlspecialchars(
                        (string) $currentUser['last_name'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </span>
            <?php endif; ?>

            <a href="/logout">
                Déconnexion
            </a>
        <?php endif; ?>
    </nav>
</header>