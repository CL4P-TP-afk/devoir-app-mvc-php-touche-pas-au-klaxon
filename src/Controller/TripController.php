<?php

declare(strict_types=1);

namespace Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller;

use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Trip;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Model\Agency;

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
    /**
     * Displays the trip creation form.
     */
    public function create(): void
    {
        $agencyModel = new Agency();

        $agencies = $agencyModel->findAll();
        $currentUser = SessionService::getUser();

        require dirname(__DIR__, 2) . '/templates/trips/create.php';
    }
    /**
     * Validates and stores a new trip.
     */
    public function store(): void
    {
        $departureAgencyId = (int) ($_POST['departure_agency_id'] ?? 0);
        $arrivalAgencyId = (int) ($_POST['arrival_agency_id'] ?? 0);

        $departureDateTime = trim(
            (string) ($_POST['departure_date_time'] ?? '')
        );

        $arrivalDateTime = trim(
            (string) ($_POST['arrival_date_time'] ?? '')
        );

        $totalSeats = (int) ($_POST['total_seats'] ?? 0);
        $availableSeats = (int) ($_POST['available_seats'] ?? -1);

        $contactPhone = trim(
            (string) ($_POST['contact_phone'] ?? '')
        );

        $contactEmail = trim(
            (string) ($_POST['contact_email'] ?? '')
        );

        if (
            $departureAgencyId <= 0
            || $arrivalAgencyId <= 0
            || $departureDateTime === ''
            || $arrivalDateTime === ''
            || $totalSeats <= 0
            || $availableSeats < 0
            || $contactPhone === ''
            || $contactEmail === ''
        ) {
            $this->redirectToCreateWithError(
                'All fields are required.'
            );
        }

        if ($departureAgencyId === $arrivalAgencyId) {
            $this->redirectToCreateWithError(
                'Departure and arrival agencies must be different.'
            );
        }

        $agencyModel = new Agency();

        if (
            !$agencyModel->exists($departureAgencyId)
            || !$agencyModel->exists($arrivalAgencyId)
        ) {
            $this->redirectToCreateWithError(
                'The selected agency does not exist.'
            );
        }

        if (
            strtotime($departureDateTime) === false
            || strtotime($arrivalDateTime) === false
            || strtotime($arrivalDateTime) <= strtotime($departureDateTime)
        ) {
            $this->redirectToCreateWithError(
                'Arrival date and time must be later than departure date and time.'
            );
        }

        if ($availableSeats > $totalSeats) {
            $this->redirectToCreateWithError(
                'Available seats cannot exceed total seats.'
            );
        }

        if (filter_var($contactEmail, FILTER_VALIDATE_EMAIL) === false) {
            $this->redirectToCreateWithError(
                'The contact email address is invalid.'
            );
        }

        $userId = SessionService::getUserId();

        if ($userId === null) {
            header('Location: /login');
            exit;
        }

        $this->tripModel->create([
            'departure_date_time' => $departureDateTime,
            'arrival_date_time' => $arrivalDateTime,
            'total_seats' => $totalSeats,
            'available_seats' => $availableSeats,
            'contact_phone' => $contactPhone,
            'contact_email' => $contactEmail,
            'user_id' => $userId,
            'departure_agency_id' => $departureAgencyId,
            'arrival_agency_id' => $arrivalAgencyId,
        ]);

        SessionService::setFlash(
            'success',
            'Trip created successfully.'
        );

        header('Location: /');
        exit;
    }

    /**
     * Redirects to the trip creation form with an error message.
     */
    private function redirectToCreateWithError(string $message): never
    {
        SessionService::setFlash('error', $message);

        header('Location: /trips/create');
        exit;
    }
    /**
     * Displays the trip edit form.
     *
     * @param int $id Trip identifier.
     */
    public function edit(int $id): void
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

        $userId = SessionService::getUserId();

        if ($userId === null || (int) $trip['user_id'] !== $userId) {
            SessionService::setFlash(
                'error',
                'You are not authorized to edit this trip.'
            );

            header('Location: /');
            exit;
        }

        $agencyModel = new Agency();
        $agencies = $agencyModel->findAll();

        require dirname(__DIR__, 2) . '/templates/trips/edit.php';
    }
    /**
     * Validates and updates an existing trip.
     *
     * @param int $id Trip identifier.
     */
    public function update(int $id): void
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

        $userId = SessionService::getUserId();

        if ($userId === null || (int) $trip['user_id'] !== $userId) {
            SessionService::setFlash(
                'error',
                'You are not authorized to edit this trip.'
            );

            header('Location: /');
            exit;
        }

        $departureAgencyId = (int) ($_POST['departure_agency_id'] ?? 0);
        $arrivalAgencyId = (int) ($_POST['arrival_agency_id'] ?? 0);

        $departureDateTime = trim(
            (string) ($_POST['departure_date_time'] ?? '')
        );

        $arrivalDateTime = trim(
            (string) ($_POST['arrival_date_time'] ?? '')
        );

        $totalSeats = (int) ($_POST['total_seats'] ?? 0);
        $availableSeats = (int) ($_POST['available_seats'] ?? -1);

        $contactPhone = trim(
            (string) ($_POST['contact_phone'] ?? '')
        );

        $contactEmail = trim(
            (string) ($_POST['contact_email'] ?? '')
        );

        if (
            $departureAgencyId <= 0
            || $arrivalAgencyId <= 0
            || $departureDateTime === ''
            || $arrivalDateTime === ''
            || $totalSeats <= 0
            || $availableSeats < 0
            || $contactPhone === ''
            || $contactEmail === ''
        ) {
            $this->redirectToEditWithError(
                $id,
                'All fields are required.'
            );
        }

        if ($departureAgencyId === $arrivalAgencyId) {
            $this->redirectToEditWithError(
                $id,
                'Departure and arrival agencies must be different.'
            );
        }

        $agencyModel = new Agency();

        if (
            !$agencyModel->exists($departureAgencyId)
            || !$agencyModel->exists($arrivalAgencyId)
        ) {
            $this->redirectToEditWithError(
                $id,
                'The selected agency does not exist.'
            );
        }

        if (
            strtotime($departureDateTime) === false
            || strtotime($arrivalDateTime) === false
            || strtotime($arrivalDateTime) <= strtotime($departureDateTime)
        ) {
            $this->redirectToEditWithError(
                $id,
                'Arrival date and time must be later than departure date and time.'
            );
        }

        if ($availableSeats > $totalSeats) {
            $this->redirectToEditWithError(
                $id,
                'Available seats cannot exceed total seats.'
            );
        }

        if (filter_var($contactEmail, FILTER_VALIDATE_EMAIL) === false) {
            $this->redirectToEditWithError(
                $id,
                'The contact email address is invalid.'
            );
        }

        $this->tripModel->update($id, [
            'departure_date_time' => $departureDateTime,
            'arrival_date_time' => $arrivalDateTime,
            'total_seats' => $totalSeats,
            'available_seats' => $availableSeats,
            'contact_phone' => $contactPhone,
            'contact_email' => $contactEmail,
            'departure_agency_id' => $departureAgencyId,
            'arrival_agency_id' => $arrivalAgencyId,
        ]);

        SessionService::setFlash(
            'success',
            'Trip updated successfully.'
        );

        header('Location: /');
        exit;
    }

    /**
     * Redirects to the trip edit form with an error message.
     *
     * @param int $id Trip identifier.
     */
    private function redirectToEditWithError(
        int $id,
        string $message
    ): never {
        SessionService::setFlash('error', $message);

        header("Location: /trips/{$id}/edit");
        exit;
    }
    /**
     * Deletes a trip owned by the authenticated user.
     *
     * @param int $id Trip identifier.
     */
    public function delete(int $id): void
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

        $userId = SessionService::getUserId();

        if ($userId === null || (int) $trip['user_id'] !== $userId) {
            SessionService::setFlash(
                'error',
                'You are not authorized to delete this trip.'
            );

            header('Location: /');
            exit;
        }

        $this->tripModel->delete($id);

        SessionService::setFlash(
            'success',
            'Trip deleted successfully.'
        );

        header('Location: /');
        exit;
    }

}