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
    /**
     * Returns an agency by its identifier.
     *
     * @param int $id Agency identifier.
     *
     * @return array<string, mixed>|null
     */
    public function findById(int $id): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT id, name
            FROM agencies
            WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
        ]);

        $agency = $statement->fetch(PDO::FETCH_ASSOC);

        return $agency !== false ? $agency : null;
    }

    /**
     * Creates a new agency.
     *
     * @param string $name Agency name.
     *
     * @return int Created agency identifier.
     */
    public function create(string $name): int
    {
        $statement = $this->connection->prepare(
            'INSERT INTO agencies (name)
            VALUES (:name)'
        );

        $statement->execute([
            'name' => $name,
        ]);

        return (int) $this->connection->lastInsertId();
    }

    /**
     * Updates an agency.
     *
     * @param int    $id   Agency identifier.
     * @param string $name New agency name.
     *
     * @return bool
     */
    public function update(int $id, string $name): bool
    {
        $statement = $this->connection->prepare(
            'UPDATE agencies
            SET name = :name
            WHERE id = :id'
        );

        return $statement->execute([
            'id' => $id,
            'name' => $name,
        ]);
    }

    /**
     * Deletes an agency.
     *
     * @param int $id Agency identifier.
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $statement = $this->connection->prepare(
            'DELETE FROM agencies
            WHERE id = :id'
        );

        return $statement->execute([
            'id' => $id,
        ]);
    }
}