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

        // Database insertion will be added in the next step.
        SessionService::setFlash(
            'success',
            'Trip data is valid.'
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

}