<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Middleware;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

/**
 * Protects routes that require authentication.
 */
class AuthMiddleware
{
    /**
     * Redirects unauthenticated users to the login page.
     */
    public static function requireAuthentication(): void
    {
        if (!SessionService::isAuthenticated()) {
            SessionService::setFlash(
                'error',
                'You must be logged in to access this page.'
            );

            header('Location: /login');
            exit;
        }
    }

    /**
     * Redirects non-administrator users to the home page.
     */
    public static function requireAdmin(): void
    {
        self::requireAuthentication();

        $user = SessionService::getUser();

        if (($user['role'] ?? null) !== 'admin') {
            SessionService::setFlash(
                'error',
                'You are not authorized to access this page.'
            );

            header('Location: /');
            exit;
        }
    }
}