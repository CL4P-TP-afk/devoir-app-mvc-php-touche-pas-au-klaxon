CREATE DATABASE IF NOT EXISTS touche_pas_au_klaxon
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE touche_pas_au_klaxon;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);

CREATE TABLE agencies (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE trips (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    departure_date_time DATETIME NOT NULL,
    arrival_date_time DATETIME NOT NULL,
    total_seats INT UNSIGNED NOT NULL,
    available_seats INT UNSIGNED NOT NULL,
    contact_phone VARCHAR(20) NOT NULL,
    contact_email VARCHAR(255) NOT NULL,

    user_id INT UNSIGNED NOT NULL,
    departure_agency_id INT UNSIGNED NOT NULL,
    arrival_agency_id INT UNSIGNED NOT NULL,

    CONSTRAINT fk_trips_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_trips_departure_agency
        FOREIGN KEY (departure_agency_id)
        REFERENCES agencies(id)
        ON DELETE RESTRICT,

    CONSTRAINT fk_trips_arrival_agency
        FOREIGN KEY (arrival_agency_id)
        REFERENCES agencies(id)
        ON DELETE RESTRICT,

    CONSTRAINT chk_trip_agencies
        CHECK (departure_agency_id <> arrival_agency_id),

    CONSTRAINT chk_trip_dates
        CHECK (arrival_date_time > departure_date_time),

    CONSTRAINT chk_trip_seats
        CHECK (available_seats <= total_seats)
);