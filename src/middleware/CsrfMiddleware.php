<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Middleware;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

/**
 * Protects state-changing requests against CSRF attacks.
 */
class CsrfMiddleware
{
    /**
     * Validates the CSRF token from the submitted form.
     */
    public static function validate(string $redirectUrl): void
    {
        $token = $_POST['csrf_token'] ?? null;

        if (
            !is_string($token)
            || !SessionService::isCsrfTokenValid($token)
        ) {
            SessionService::setFlash(
                'error',
                'Invalid request. Please try again.'
            );

            header("Location: {$redirectUrl}");
            exit;
        }
    }
}