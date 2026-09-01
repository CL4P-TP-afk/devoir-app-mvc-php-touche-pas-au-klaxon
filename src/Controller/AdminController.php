<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Agency;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Trip;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\User;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;

/**
 * Handles administration pages.
 */
class AdminController
{
    private User $userModel;
    private Agency $agencyModel;
    private Trip $tripModel;

    /**
     * Initializes the administration controller.
     */
    public function __construct()
    {
        $this->userModel = new User();
        $this->agencyModel = new Agency();
        $this->tripModel = new Trip();
    }

    /**
     * Displays the administration dashboard.
     */
    public function dashboard(): void
    {
        $users = $this->userModel->findAll();
        $agencies = $this->agencyModel->findAll();
        $trips = $this->tripModel->findAll();

        require dirname(__DIR__, 2)
            . '/templates/admin/dashboard.php';
    }
    /**
     * Displays the agency creation form.
     */
    public function createAgency(): void
    {
        require dirname(__DIR__, 2)
            . '/templates/admin/agencies/create.php';
    }

    /**
     * Stores a new agency.
     */
    public function storeAgency(): void
    {
        $name = trim((string) ($_POST['name'] ?? ''));

        if ($name === '') {
            SessionService::setFlash(
                'error',
                'Le nom de l\'agence est obligatoire.'
            );

            header('Location: /admin/agencies/create');
            exit;
        }

        $this->agencyModel->create($name);

        SessionService::setFlash(
            'success',
            'L\'agence a été créée avec succès.'
        );

        header('Location: /admin');
        exit;
    }
}