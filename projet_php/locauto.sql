-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 27 Février 2014 à 15:27
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `locauto`
--
CREATE DATABASE IF NOT EXISTS `locauto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `locauto`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` varchar(1) NOT NULL,
  `categorie` varchar(256) NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  UNIQUE KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `categorie`, `prix`) VALUES
('A', 'Citadine', '60.00'),
('B', 'Economique', '72.00'),
('C', 'Compacte', '80.00'),
('D', 'Intermediaire', '95.00'),
('E', 'Berline', '120.00'),
('F', 'Grande berline', '150.00'),
('G', 'Sport, SUV', '230.00'),
('V', 'Luxe', '350.00');

-- --------------------------------------------------------

--
-- Structure de la table `choixoptions`
--

CREATE TABLE IF NOT EXISTS `choixoptions` (
  `id_choix_option` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  `id_louer` int(11) NOT NULL,
  UNIQUE KEY `id_choix_option` (`id_choix_option`),
  KEY `id_option` (`id_option`,`id_louer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL,
  `id_type_client` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  UNIQUE KEY `id_client` (`id_client`),
  KEY `id_type_client` (`id_type_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `louer`
--

CREATE TABLE IF NOT EXISTS `louer` (
  `id_louer` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `immatriculation` varchar(16) NOT NULL,
  `date_debut` varchar(10) NOT NULL,
  `date_fin` varchar(10) NOT NULL,
  `compteur_debut` int(11) NOT NULL,
  `compteur_fin` int(11) NOT NULL,
  UNIQUE KEY `id_louer` (`id_louer`),
  KEY `id_client` (`id_client`,`immatriculation`),
  KEY `immatriculation` (`immatriculation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id_option` int(11) NOT NULL,
  `option` varchar(256) NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  UNIQUE KEY `id_option` (`id_option`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `options`
--

INSERT INTO `options` (`id_option`, `option`, `prix`) VALUES
(1, 'Assurance complementaire', '50.00'),
(2, 'Nettoyage', '75.00'),
(3, 'Complement carburant', '30.00'),
(4, 'Retour autre ville', '250.00'),
(5, 'Rabais dimanche', '-40.00');

-- --------------------------------------------------------

--
-- Structure de la table `typesclient`
--

CREATE TABLE IF NOT EXISTS `typesclient` (
  `id_type_client` int(11) NOT NULL,
  `type_client` varchar(256) NOT NULL,
  UNIQUE KEY `id_type_client` (`id_type_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typesclient`
--

INSERT INTO `typesclient` (`id_type_client`, `type_client`) VALUES
(1, 'Particulier'),
(2, 'Entreprise'),
(3, 'Administration'),
(4, 'Association'),
(5, 'Longue duree');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE IF NOT EXISTS `voitures` (
  `immatriculation` varchar(16) NOT NULL,
  `marque` varchar(256) NOT NULL,
  `modele` varchar(256) NOT NULL,
  `image` varchar(64) NOT NULL,
  `compteur` int(11) NOT NULL,
  `id_categorie` varchar(1) NOT NULL,
  UNIQUE KEY `id_voiture` (`immatriculation`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voitures`
--

INSERT INTO `voitures` (`immatriculation`, `marque`, `modele`, `image`, `compteur`, `id_categorie`) VALUES
('123 ABC 456', 'Alfa Romeo', 'Giulietta', 'alfa-romeo-giulietta.jpg', 2055, 'D'),
('215 QKX 284', 'Ford', 'S-Max', 'ford-smax.jpg', 27655, 'E'),
('234 ATV 765', 'B.M.W.', 'Série 3', 'bmw-3.jpg', 5789, 'D'),
('238 SFG 387', 'B.M.W.', 'Série 7', 'bmw-7.jpg', 19867, 'F'),
('241 GST 356', 'Volkswagen', 'Polo', 'vw-polo.jpg', 21765, 'B'),
('293 LXU 428', 'Ford', 'Kuga', 'ford-kuga.jpg', 3682, 'G'),
('349 DES 974', 'Peugeot', '308', 'peugeot-308.jpg', 6548, 'B'),
('426 DEH 935', 'Fiat', 'Cinquecento', 'fiat-500.jpg', 12546, 'A'),
('427 XHQ 765', 'Mercedes', 'Classe E', 'mercedes-e.jpg', 23768, 'F'),
('470 DKJ 639', 'Peugeot', '308 Break', 'peugeot-308-break.jpg', 28476, 'C'),
('537 QSD 276', 'Infinity', 'Q50', 'infiniti-q50.jpg', 6548, 'G'),
('542 SQU 387', 'B.M.W.', 'X5', 'bmw-x5.jpg', 128, 'V'),
('543 KDE 735', 'Opel', 'Astra Break', 'opel-astra-break.jpg', 43276, 'D'),
('634 DJH 724', 'Smart', 'For Two', 'smart-fortwo.jpg', 23102, 'A'),
('654 HDY 528', 'Peugeot', '308 Break', 'peugeot-308-break.jpg', 8545, 'C'),
('732 HFD 383', 'Smart', 'For Two', 'smart-fortwo.jpg', 6543, 'A'),
('734 SED 359', 'Peugeot', '308', 'peugeot-308.jpg', 12345, 'B'),
('744 HFS 296', 'Volkswagen', 'Polo', 'vw-polo.jpg', 44346, 'B'),
('753 FSC 945', 'Skoda', 'Octavia Break', 'skoda-octavia-break.jpg', 7654, 'D'),
('753 SUR 871', 'Peugeot', '308', 'peugeot-308.jpg', 21865, 'B'),
('754 GYH 749', 'B.M.W.', 'X1', 'bmw-x1.jpg', 250, 'G'),
('765 HDW 347', 'Volkswagen', 'Scirocco', 'vw-scirocco.jpg', 7534, 'D'),
('765 KJH 364', 'Jaguar', 'XF', 'jaguar-xf.jpg', 7652, 'V'),
('765 SRC 234', 'B.M.W.', 'Série 3 Break', 'bmw-3-break.jpg', 9864, 'E'),
('853 DJY 284', 'Mini', 'Cooper', 'mini-cooper.jpg', 76443, 'C'),
('857 HDE 248', 'Porsche', 'Panamera', 'porsche-panamera.jpg', 7538, 'V'),
('863 NBS 738', 'Fiat', 'Cinquecento', 'fiat-500.jpg', 28765, 'A'),
('864 LQD 482', 'Citroen', 'Jumpy 9 places', 'citroen-jumpy.jpg', 7646, 'E'),
('865 KSC 912', 'Ford', 'C-Max', 'ford-cmax.jpg', 27486, 'D'),
('873 MHF 487', 'Mercedes', 'Classe B', 'mercedes-b.jpg', 76534, 'E'),
('934 KDS 452', 'Volkswagen', 'Passat Break', 'vw-passat-break.jpg', 12635, 'C'),
('985 FSZ 238', 'Peugeot', '3008', 'peugeot-3008.jpg', 8543, 'D');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `client_type_client` FOREIGN KEY (`id_type_client`) REFERENCES `typesclient` (`id_type_client`);

--
-- Contraintes pour la table `louer`
--
ALTER TABLE `louer`
  ADD CONSTRAINT `louer_voiture` FOREIGN KEY (`immatriculation`) REFERENCES `voitures` (`immatriculation`),
  ADD CONSTRAINT `louer_client` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`);

--
-- Contraintes pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD CONSTRAINT `voiture_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`);


ALTER TABLE voitures ADD image VARCHAR(255);

ALTER TABLE voitures ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY;

CREATE TABLE IF NOT EXISTS `reservations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `car_id` INT NOT NULL,
    `days` INT NOT NULL,
    `kilometers` INT NOT NULL,
    `reservation_date` DATE NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`car_id`) REFERENCES `voitures`(`id`)
);

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `voitures` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `immatriculation` VARCHAR(50) NOT NULL,
    `marque` VARCHAR(50) NOT NULL,
    `modele` VARCHAR(50) NOT NULL,
    `image` VARCHAR(100) NOT NULL,
    `compteur` INT NOT NULL
);

CREATE TABLE IF NOT EXISTS `reservations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `car_id` INT NOT NULL,
    `days` INT NOT NULL,
    `kilometers` INT NOT NULL,
    `reservation_date` DATE NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`car_id`) REFERENCES `voitures`(`id`)
);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

