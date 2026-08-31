<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Trip;

/**
 * Handles the public home page.
 */
class HomeController
{
    private Trip $tripModel;

    /**
     * Initializes the home controller.
     */
    public function __construct()
    {
        $this->tripModel = new Trip();
    }

    /**
     * Displays the public home page.
     */
    public function index(): void
    {
        $trips = $this->tripModel->findAvailableUpcoming();

        require dirname(__DIR__, 2) . '/templates/home/index.php';
    }
}