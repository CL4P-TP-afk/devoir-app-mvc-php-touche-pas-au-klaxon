<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Agency;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Database;
use PHPUnit\Framework\TestCase;

class AgencyTest extends TestCase
{
    protected function setUp(): void
    {
        if ($_ENV['DB_HOST'] ?? null) {
            return;
        }

        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
    }

    public function testAgencyCanBeCreated(): void
    {
        $agencyModel = new Agency();
        $connection = Database::getConnection();

        $agencyId = null;

        try {
            $agencyId = $agencyModel->create('Agence PHPUnit Create');

            $agency = $agencyModel->findById($agencyId);

            $this->assertNotNull($agency);
            $this->assertSame(
                'Agence PHPUnit Create',
                $agency['name']
            );
        } finally {
            if ($agencyId !== null) {
                $statement = $connection->prepare(
                    'DELETE FROM agencies WHERE id = :id'
                );

                $statement->execute([
                    'id' => $agencyId,
                ]);
            }
        }
    }

    public function testAgencyCanBeUpdated(): void
    {
        $agencyModel = new Agency();
        $connection = Database::getConnection();

        $agencyId = $agencyModel->create(
            'Agence PHPUnit Before Update'
        );

        try {
            $updated = $agencyModel->update(
                $agencyId,
                'Agence PHPUnit After Update'
            );

            $agency = $agencyModel->findById($agencyId);

            $this->assertTrue($updated);
            $this->assertNotNull($agency);
            $this->assertSame(
                'Agence PHPUnit After Update',
                $agency['name']
            );
        } finally {
            $statement = $connection->prepare(
                'DELETE FROM agencies WHERE id = :id'
            );

            $statement->execute([
                'id' => $agencyId,
            ]);
        }
    }

    public function testAgencyCanBeDeleted(): void
    {
        $agencyModel = new Agency();

        $agencyId = $agencyModel->create(
            'Agence PHPUnit Delete'
        );

        $deleted = $agencyModel->delete($agencyId);

        $this->assertTrue($deleted);
        $this->assertNull(
            $agencyModel->findById($agencyId)
        );
    }
}