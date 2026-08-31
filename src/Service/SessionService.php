<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service;

/**
 * Manages the authenticated user session.
 */
class SessionService
{
    /**
     * Starts the PHP session when necessary.
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Stores the authenticated user in the session.
     *
     * @param array<string, mixed> $user Authenticated user data.
     */
    public static function login(array $user): void
    {
        self::start();

        session_regenerate_id(true);

        $_SESSION['user'] = $user;
    }

    /**
     * Returns the authenticated user.
     *
     * @return array<string, mixed>|null
     */
    public static function getUser(): ?array
    {
        self::start();

        $user = $_SESSION['user'] ?? null;

        return is_array($user) ? $user : null;
    }

    /**
     * Checks whether a user is authenticated.
     */
    public static function isAuthenticated(): bool
    {
        return self::getUser() !== null;
    }

    /**
     * Logs the current user out.
     */
    public static function logout(): void
    {
        self::start();

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $parameters = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $parameters['path'],
                $parameters['domain'],
                $parameters['secure'],
                $parameters['httponly']
            );
        }

        session_destroy();
    }

    /**
     * Stores a flash message in the session.
     */
    public static function setFlash(string $type, string $message): void
    {
        self::start();

        $_SESSION['flash'][$type] = $message;
    }

    /**
     * Returns and removes a flash message from the session.
     */
    public static function getFlash(string $type): ?string
    {
        self::start();

        $message = $_SESSION['flash'][$type] ?? null;

        unset($_SESSION['flash'][$type]);

        return is_string($message) ? $message : null;
    }
    /**
     * Checks whether the authenticated user is an administrator.
     */
    public static function isAdmin(): bool
    {
        $user = self::getUser();

        return ($user['role'] ?? null) === 'admin';
    }

    /**
     * Returns the identifier of the authenticated user.
     */
    public static function getUserId(): ?int
    {
        $user = self::getUser();

        if (!isset($user['id']) || !is_int($user['id'])) {
            return null;
        }

        return $user['id'];
    }
}