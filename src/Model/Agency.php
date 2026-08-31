<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model;

use PDO;

/**
 * Provides database operations related to agencies.
 */
class Agency
{
    private PDO $connection;

    /**
     * Initializes the agency model.
     */
    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    /**
     * Returns all agencies ordered by name.
     *
     * @return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        $statement = $this->connection->prepare(
            'SELECT id, name
             FROM agencies
             ORDER BY name ASC'
        );

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Checks whether an agency exists.
     *
     * @param int $id Agency identifier.
     */
    public function exists(int $id): bool
    {
        $statement = $this->connection->prepare(
            'SELECT COUNT(*)
            FROM agencies
            WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
        ]);

        return (int) $statement->fetchColumn() > 0;
    }
}