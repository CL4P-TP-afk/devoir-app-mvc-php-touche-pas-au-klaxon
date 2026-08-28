<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\User;

/**
 * Handles user authentication.
 */
class AuthService
{
    private User $userModel;

    /**
     * Initializes the authentication service.
     */
    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Authenticates a user with an email address and password.
     *
     * @param string $email User email address.
     * @param string $password Plain-text password submitted by the user.
     *
     * @return array<string, mixed>|null Authenticated user data or null on failure.
     */
    public function authenticate(string $email, string $password): ?array
    {
        $user = $this->userModel->findByEmail($email);

        if ($user === null) {
            return null;
        }

        if (!password_verify($password, $user['password'])) {
            return null;
        }

        unset($user['password']);

        return $user;
    }
}