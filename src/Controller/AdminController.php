<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Agency;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Trip;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\User;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;
use PDOException;

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
    /**
     * Displays the agency edition form.
     */
    public function editAgency(int $id): void
    {
        $agency = $this->agencyModel->findById($id);

        if ($agency === null) {
            SessionService::setFlash(
                'error',
                'Agence introuvable.'
            );

            header('Location: /admin');
            exit;
        }

        require dirname(__DIR__, 2)
            . '/templates/admin/agencies/edit.php';
    }

    /**
     * Updates an agency.
     */
    public function updateAgency(int $id): void
    {
        $agency = $this->agencyModel->findById($id);

        if ($agency === null) {
            SessionService::setFlash(
                'error',
                'Agence introuvable.'
            );

            header('Location: /admin');
            exit;
        }

        $name = trim((string) ($_POST['name'] ?? ''));

        if ($name === '') {
            SessionService::setFlash(
                'error',
                'Le nom de l\'agence est obligatoire.'
            );

            header("Location: /admin/agencies/{$id}/edit");
            exit;
        }

        $this->agencyModel->update($id, $name);

        SessionService::setFlash(
            'success',
            'L\'agence a été modifiée avec succès.'
        );

        header('Location: /admin');
        exit;
    }
    /**
     * Deletes an agency.
     */
    public function deleteAgency(int $id): void
    {
        $agency = $this->agencyModel->findById($id);

        if ($agency === null) {
            SessionService::setFlash(
                'error',
                'Agence introuvable.'
            );

            header('Location: /admin');
            exit;
        }

        try {
            $this->agencyModel->delete($id);

            SessionService::setFlash(
                'success',
                'L\'agence a été supprimée avec succès.'
            );
        } catch (PDOException $exception) {
            SessionService::setFlash(
                'error',
                'Impossible de supprimer cette agence car elle est utilisée par un trajet.'
            );
        }

        header('Location: /admin');
        exit;
    }
    /**
     * Deletes a trip from the administration dashboard.
     */
    public function deleteTrip(int $id): void
    {
        $trip = $this->tripModel->findById($id);

        if ($trip === null) {
            SessionService::setFlash(
                'error',
                'Trajet introuvable.'
            );

            header('Location: /admin');
            exit;
        }

        $this->tripModel->delete($id);

        SessionService::setFlash(
            'success',
            'Le trajet a été supprimé avec succès.'
        );

        header('Location: /admin');
        exit;
    }
}