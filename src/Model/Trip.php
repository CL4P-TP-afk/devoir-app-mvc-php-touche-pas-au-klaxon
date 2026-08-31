<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model;

use PDO;

/**
 * Provides database operations related to trips.
 */
class Trip
{
    private PDO $connection;

    /**
     * Initializes the trip model with the database connection.
     */
    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    /**
     * Returns upcoming trips with available seats.
     *
     * @return array<int, array<string, mixed>>
     */
    public function findAvailableUpcoming(): array
    {
        $statement = $this->connection->prepare(
            'SELECT
                trips.id,
                trips.departure_date_time,
                trips.arrival_date_time,
                trips.total_seats,
                trips.available_seats,
                trips.contact_phone,
                trips.contact_email,
                trips.user_id,
                users.first_name,
                users.last_name,
                departure_agency.name AS departure_agency,
                arrival_agency.name AS arrival_agency
            FROM trips
            INNER JOIN users
                ON users.id = trips.user_id
            INNER JOIN agencies AS departure_agency
                ON departure_agency.id = trips.departure_agency_id
            INNER JOIN agencies AS arrival_agency
                ON arrival_agency.id = trips.arrival_agency_id
            WHERE trips.departure_date_time > NOW()
              AND trips.available_seats > 0
            ORDER BY trips.departure_date_time ASC'
        );

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Finds a trip by identifier.
     *
     * @param int $id Trip identifier.
     *
     * @return array<string, mixed>|null The trip data or null if not found.
     */
    public function findById(int $id): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT
                trips.id,
                trips.departure_date_time,
                trips.arrival_date_time,
                trips.total_seats,
                trips.available_seats,
                trips.contact_phone,
                trips.contact_email,
                trips.user_id,
                users.first_name,
                users.last_name,
                departure_agency.name AS departure_agency,
                arrival_agency.name AS arrival_agency
            FROM trips
            INNER JOIN users
                ON users.id = trips.user_id
            INNER JOIN agencies AS departure_agency
                ON departure_agency.id = trips.departure_agency_id
            INNER JOIN agencies AS arrival_agency
                ON arrival_agency.id = trips.arrival_agency_id
            WHERE trips.id = :id'
        );

        $statement->execute([
            'id' => $id,
        ]);

        $trip = $statement->fetch(PDO::FETCH_ASSOC);

        return $trip !== false ? $trip : null;
    }
    /**
     * Creates a new trip.
     *
     * @param array<string, mixed> $data Trip data.
     *
     * @return int Identifier of the created trip.
     */
    public function create(array $data): int
    {
        $statement = $this->connection->prepare(
            'INSERT INTO trips (
                departure_date_time,
                arrival_date_time,
                total_seats,
                available_seats,
                contact_phone,
                contact_email,
                user_id,
                departure_agency_id,
                arrival_agency_id
            ) VALUES (
                :departure_date_time,
                :arrival_date_time,
                :total_seats,
                :available_seats,
                :contact_phone,
                :contact_email,
                :user_id,
                :departure_agency_id,
                :arrival_agency_id
            )'
        );

        $statement->execute([
            'departure_date_time' => $data['departure_date_time'],
            'arrival_date_time' => $data['arrival_date_time'],
            'total_seats' => $data['total_seats'],
            'available_seats' => $data['available_seats'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email'],
            'user_id' => $data['user_id'],
            'departure_agency_id' => $data['departure_agency_id'],
            'arrival_agency_id' => $data['arrival_agency_id'],
        ]);

        return (int) $this->connection->lastInsertId();
    }
}