<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\AuthService;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

/**
 * Handles user authentication actions.
 */
class AuthController
{
    private AuthService $authService;

    /**
     * Initializes the authentication controller.
     */
    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * Displays the login page.
     */
    public function showLogin(): void
    {
        require dirname(__DIR__, 2) . '/templates/auth/login.php';
    }

    /**
     * Handles the login form submission.
     */
    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
           SessionService::setFlash(
                'error',
                'Email and password are required.'
            );

            header('Location: /login');
            exit;
        }

        $user = $this->authService->authenticate($email, $password);

        if ($user === null) {
            SessionService::setFlash(
                'error',
                'Invalid email or password.'
            );

            header('Location: /login');
            exit;
        }

        SessionService::login($user);

        header('Location: /');
        exit;
    }

    /**
     * Logs the authenticated user out.
     */
    public function logout(): void
    {
        SessionService::logout();

        header('Location: /login');
        exit;
    }
}