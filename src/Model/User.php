<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model;

use PDO;

/**
 * Provides database operations related to users.
 */
class User
{
    private PDO $connection;

    /**
     * Initializes the user model with the database connection.
     */
    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    /**
     * Finds a user by email address.
     *
     * @param string $email User email address.
     *
     * @return array<string, mixed>|null The user data or null if not found.
     */
    public function findByEmail(string $email): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT id, first_name, last_name, phone, email, password, role
             FROM users
             WHERE email = :email'
        );

        $statement->execute([
            'email' => $email,
        ]);

        $user = $statement->fetch();

        return $user !== false ? $user : null;
    }

    /**
     * Finds a user by identifier.
     *
     * @param int $id User identifier.
     *
     * @return array<string, mixed>|null The user data or null if not found.
     */
    public function findById(int $id): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT id, first_name, last_name, phone, email, role
             FROM users
             WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
        ]);

        $user = $statement->fetch();

        return $user !== false ? $user : null;
    }
    /**
     * Returns all users ordered by last name and first name.
     *
     * @return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        $statement = $this->connection->prepare(
            'SELECT
                id,
                first_name,
                last_name,
                phone,
                email,
                role
            FROM users
            ORDER BY last_name ASC, first_name ASC'
        );

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}