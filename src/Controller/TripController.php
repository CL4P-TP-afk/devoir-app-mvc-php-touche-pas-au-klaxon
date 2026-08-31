<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Trip;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

/**
 * Handles trip-related pages.
 */
class TripController
{
    private Trip $tripModel;

    /**
     * Initializes the trip controller.
     */
    public function __construct()
    {
        $this->tripModel = new Trip();
    }

    /**
     * Displays the details of a trip.
     *
     * @param int $id Trip identifier.
     */
    public function show(int $id): void
    {
        $trip = $this->tripModel->findById($id);

        if ($trip === null) {
            SessionService::setFlash(
                'error',
                'Trip not found.'
            );

            header('Location: /');
            exit;
        }

        require dirname(__DIR__, 2) . '/templates/trips/show.php';
    }
}