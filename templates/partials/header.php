<?php

declare(strict_types=1);

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

$currentUser = SessionService::getUser();
$isAuthenticated = SessionService::isAuthenticated();
$isAdmin = SessionService::isAdmin();

$homeUrl = $isAdmin ? '/admin' : '/';
?>

<header class="bg-secondary sticky-top">
    <nav class="navbar navbar-expand px-4">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="<?= $homeUrl ?>">
                Touche pas au klaxon
            </a>

            <div class="d-flex align-items-center gap-3">
                <?php if (!$isAuthenticated): ?>
                    <a class="btn btn-primary" href="/login">
                        Connexion
                    </a>

                <?php elseif ($isAdmin): ?>
                    <a class="text-white text-decoration-none" href="/admin#users">
                        Utilisateurs
                    </a>

                    <a class="text-white text-decoration-none" href="/admin#agencies">
                        Agences
                    </a>

                    <a class="text-white text-decoration-none" href="/admin#trips">
                        Trajets
                    </a>

                    <form action="/logout" method="POST" class="m-0">
                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= htmlspecialchars(
                                SessionService::getCsrfToken(),
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                        >

                        <button type="submit" class="btn btn-light">
                            Déconnexion
                        </button>
                    </form>

                <?php else: ?>
                    <a class="btn btn-primary" href="/trips/create">
                        Proposer un trajet
                    </a>

                    <?php if ($currentUser !== null): ?>
                        <span class="text-white">
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

                    <form action="/logout" method="POST" class="m-0">
                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= htmlspecialchars(
                                SessionService::getCsrfToken(),
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                        >

                        <button type="submit" class="btn btn-light">
                            Déconnexion
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>