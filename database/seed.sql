USE touche_pas_au_klaxon;

-- Agencies

INSERT INTO agencies (name) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- Users
-- Demo password for seeded users: Password123!

INSERT INTO users (
    first_name,
    last_name,
    phone,
    email,
    password,
    role
) VALUES
('Alexandre', 'Martin', '0612345678', 'alexandre.martin@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Sophie', 'Dubois', '0698765432', 'sophie.dubois@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Julien', 'Bernard', '0622446688', 'julien.bernard@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Camille', 'Moreau', '0611223344', 'camille.moreau@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Lucie', 'Lefèvre', '0777889900', 'lucie.lefevre@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Thomas', 'Leroy', '0655443322', 'thomas.leroy@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Chloé', 'Roux', '0633221199', 'chloe.roux@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Maxime', 'Petit', '0766778899', 'maxime.petit@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Laura', 'Garnier', '0688776655', 'laura.garnier@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Antoine', 'Dupuis', '0744556677', 'antoine.dupuis@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Emma', 'Lefebvre', '0699887766', 'emma.lefebvre@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Louis', 'Fontaine', '0655667788', 'louis.fontaine@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Clara', 'Chevalier', '0788990011', 'clara.chevalier@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Nicolas', 'Robin', '0644332211', 'nicolas.robin@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Marine', 'Gauthier', '0677889922', 'marine.gauthier@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Pierre', 'Fournier', '0722334455', 'pierre.fournier@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Sarah', 'Girard', '0688665544', 'sarah.girard@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Hugo', 'Lambert', '0611223366', 'hugo.lambert@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Julie', 'Masson', '0733445566', 'julie.masson@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user'),
('Arthur', 'Henry', '0666554433', 'arthur.henry@email.fr', '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2', 'user');

-- Administrator
-- Demo password: Password123!

INSERT INTO users (
    first_name,
    last_name,
    phone,
    email,
    password,
    role
) VALUES (
    'Admin',
    'Klaxon',
    '0600000000',
    'admin@touchepasauklaxon.fr',
    '$2y$10$tv7fPvTjOfI./7L3uY0ueOln2p0kLpXSdUtqXHYw6Pc36KCcibSG2',
    'admin'
);