<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Database;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Trip;
use PHPUnit\Framework\TestCase;

/**
 * Tests database write operations related to trips.
 */
final class TripTest extends TestCase
{
    /**
     * Loads the application environment before the tests.
     */
    protected function setUp(): void
    {
        if (!isset($_ENV['DB_HOST'])) {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->load();
        }
    }

    /**
     * Verifies that a trip can be created in the database.
     */
    public function testTripCanBeCreated(): void
    {
        $tripModel = new Trip();

        $tripId = $tripModel->create([
            'departure_date_time' => date(
                'Y-m-d H:i:s',
                strtotime('+10 days')
            ),
            'arrival_date_time' => date(
                'Y-m-d H:i:s',
                strtotime('+10 days +4 hours')
            ),
            'total_seats' => 4,
            'available_seats' => 3,
            'contact_phone' => '0612345678',
            'contact_email' => 'alexandre.martin@email.fr',
            'user_id' => 1,
            'departure_agency_id' => 1,
            'arrival_agency_id' => 2,
        ]);

        try {
            $trip = $tripModel->findById($tripId);

            $this->assertNotNull($trip);
            $this->assertSame($tripId, (int) $trip['id']);
            $this->assertSame(4, (int) $trip['total_seats']);
            $this->assertSame(3, (int) $trip['available_seats']);
            $this->assertSame(
                'alexandre.martin@email.fr',
                $trip['contact_email']
            );
        } finally {
            $connection = Database::getConnection();

            $statement = $connection->prepare(
                'DELETE FROM trips WHERE id = :id'
            );

            $statement->execute([
                'id' => $tripId,
            ]);
        }
    }
    /**
     * Verifies that a trip can be updated in the database.
     */
    public function testTripCanBeUpdated(): void
    {
        $tripModel = new Trip();

        $tripId = $tripModel->create([
            'departure_date_time' => date(
                'Y-m-d H:i:s',
                strtotime('+15 days')
            ),
            'arrival_date_time' => date(
                'Y-m-d H:i:s',
                strtotime('+15 days +4 hours')
            ),
            'total_seats' => 4,
            'available_seats' => 3,
            'contact_phone' => '0612345678',
            'contact_email' => 'alexandre.martin@email.fr',
            'user_id' => 1,
            'departure_agency_id' => 1,
            'arrival_agency_id' => 2,
        ]);

        try {
            $updated = $tripModel->update($tripId, [
                'departure_date_time' => date(
                    'Y-m-d H:i:s',
                    strtotime('+16 days')
                ),
                'arrival_date_time' => date(
                    'Y-m-d H:i:s',
                    strtotime('+16 days +5 hours')
                ),
                'total_seats' => 5,
                'available_seats' => 2,
                'contact_phone' => '0699999999',
                'contact_email' => 'updated@test.fr',
                'departure_agency_id' => 3,
                'arrival_agency_id' => 4,
            ]);

            $this->assertTrue($updated);

            $trip = $tripModel->findById($tripId);

            $this->assertNotNull($trip);
            $this->assertSame(5, (int) $trip['total_seats']);
            $this->assertSame(2, (int) $trip['available_seats']);
            $this->assertSame(
                '0699999999',
                $trip['contact_phone']
            );
            $this->assertSame(
                'updated@test.fr',
                $trip['contact_email']
            );
            $this->assertSame(
                3,
                (int) $trip['departure_agency_id']
            );
            $this->assertSame(
                4,
                (int) $trip['arrival_agency_id']
            );
        } finally {
            $connection = Database::getConnection();

            $statement = $connection->prepare(
                'DELETE FROM trips WHERE id = :id'
            );

            $statement->execute([
                'id' => $tripId,
            ]);
        }
    }

}