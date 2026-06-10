-- OPTI CLOUD -- Base de données compatible avec le code PHP actuel
-- Généré le : 2026-06-10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;
SET NAMES utf8;

-- --------------------------------------------------------
-- Base de données: `opticloud`
-- Créer la base si elle n'existe pas, puis l'utiliser
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `opticloud` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `opticloud`;

-- --------------------------------------------------------
-- Table `categorie`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categorie` (`nom_categorie`) VALUES
('Lunettes de vue'),
('Lunettes de soleil'),
('Lentilles de contact'),
('Accessoires'),
('Produits d\'entretien'),
('Montures enfants'),
('Montures femmes'),
('Montures hommes');

-- --------------------------------------------------------
-- Table `marque`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `marque`;
CREATE TABLE `marque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_marque` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `marque` (`nom_marque`) VALUES
('Adidas'),
('Burberry'),
('Bvlgari'),
('Chanel'),
('Calvin Klein'),
('Carrera'),
('Dolce & Gabbana'),
('Dior'),
('Emporio Armani'),
('Essilor'),
('Gucci'),
('Guess'),
('Hugo Boss'),
('Hoya'),
('Lacoste'),
('Montblanc'),
('Nikon'),
('Oakley'),
('Police'),
('Puma'),
('Prada'),
('Persol'),
('Ray-Ban'),
('Rodenstock'),
('Shamir'),
('Seiko'),
('Tom Ford'),
('Tokai'),
('Versace'),
('Zeiss');

-- --------------------------------------------------------
-- Table `fournisseur`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` varchar(100) NOT NULL,
  `tel_fournisseur` varchar(20) DEFAULT '',
  `email_fournisseur` varchar(100) DEFAULT '',
  `ville_fournisseur` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `fournisseur` (`nom_fournisseur`, `tel_fournisseur`, `email_fournisseur`, `ville_fournisseur`) VALUES
('Optique Atlas', '0522123456', 'contact@optiqueatlas.ma', 'Casablanca'),
('Vision Tanger', '0539932145', 'info@visiontanger.ma', 'Tanger'),
('Optic Rabat', '0537765432', 'contact@opticrabat.ma', 'Rabat'),
('Lunettes Agadir', '0528234567', 'service@lunettesagadir.ma', 'Agadir'),
('Optique Fes', '0535647382', 'contact@optiquefes.ma', 'Fes');

-- --------------------------------------------------------
-- Table `verre`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `verre`;
CREATE TABLE `verre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_verre` varchar(50) NOT NULL,
  `prix_verre` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_categorie` int(11) DEFAULT NULL,
  `id_marque` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `verre` (`ref_verre`, `prix_verre`, `stock`, `id_categorie`, `id_marque`) VALUES
('Essilor Crizal', 950.00, 10, 1, 10),
('Essilor EyeZen', 400.00, 15, 1, 10),
('Hoya LifeStyle', 850.00, 8, 1, 14),
('Hoya Sync', 480.00, 12, 1, 14),
('Nikon SeeMax', 420.00, 20, 1, 17),
('Nikon Presio', 880.00, 7, 1, 17),
('Rodenstock Perfection', 970.00, 5, 1, 24),
('Rodenstock Multigressif', 990.00, 6, 1, 24),
('Zeiss Individual', 1000.00, 9, 1, 30),
('Zeiss DuraVision', 520.00, 14, 1, 30);

-- --------------------------------------------------------
-- Table `monture`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `monture`;
CREATE TABLE `monture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_monture` varchar(50) NOT NULL,
  `prix_monture` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_categorie` int(11) DEFAULT NULL,
  `id_marque` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `monture` (`ref_monture`, `prix_monture`, `stock`, `id_categorie`, `id_marque`) VALUES
('CH011 Paris Chic', 2800.00, 6, 7, 4),
('TF012 Luxury Vision', 3200.00, 5, 8, 27),
('VS013 Golden Frame', 3500.00, 3, 7, 29),
('AD014 Sport Active', 1300.00, 14, 8, 1),
('NK015 Optic Clear', 1700.00, 10, 1, 17),
('MB016 Executive Line', 2900.00, 7, 8, 16),
('PL017 Street Style', 1500.00, 11, 1, 19),
('PM018 Kids Sport', 800.00, 18, 6, 20),
('BV019 Italian Elegance', 3100.00, 4, 7, 3),
('RD020 Precision Optic', 2600.00, 6, 8, 24);

-- --------------------------------------------------------
-- Table `lentille`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `lentille`;
CREATE TABLE `lentille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_lentille` varchar(50) NOT NULL,
  `prix_lentille` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_categorie` int(11) DEFAULT NULL,
  `id_marque` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lentille` (`ref_lentille`, `prix_lentille`, `stock`, `id_categorie`, `id_marque`) VALUES
('Acuvue Oasys', 180.00, 50, 3, 5),
('Air Optix Night & Day', 220.00, 40, 3, 18),
('Bausch Soflens Toric', 260.00, 30, 3, 23),
('Dailies Total 1', 150.00, 60, 3, 10),
('Biofinity Multifocal', 300.00, 25, 3, 14);

-- --------------------------------------------------------
-- Table `opticien`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `opticien`;
CREATE TABLE `opticien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_opticien` varchar(100) NOT NULL,
  `prenom_opticien` varchar(100) NOT NULL DEFAULT '',
  `tel_opticien` varchar(20) DEFAULT '',
  `email_opticien` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `opticien` (`nom_opticien`, `prenom_opticien`, `tel_opticien`, `email_opticien`) VALUES
('Benali', 'Ahmed', '0612345678', 'contact@visionplus.ma'),
('El Idrissi', 'Youssef', '0623456789', 'contact@alamal.ma'),
('Bensalem', 'Karim', '0634567890', 'atlas@optique.ma'),
('Lahlou', 'Hassan', '0645678901', 'sahara@optique.ma'),
('El Amrani', 'Mohamed', '0656789012', 'rif@optique.ma'),
('Zahra', 'Fatima', '0667890123', 'lumiere@optique.ma'),
('Chraibi', 'Abdelkader', '0678901234', 'horizon@optique.ma'),
('Belkadi', 'Samir', '0689012345', 'centrale@optique.ma'),
('El Fassi', 'Rachid', '0690123456', 'medina@optique.ma'),
('Karimi', 'Nadia', '0601234567', 'bassar@optique.ma');

-- --------------------------------------------------------
-- Table `utilisateurs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `login` varchar(60) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','employe') NOT NULL DEFAULT 'employe',
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `cree_le` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Mot de passe : admin (md5)
INSERT INTO `utilisateurs` (`nom`, `login`, `mot_de_passe`, `role`, `actif`, `cree_le`) VALUES
('Administrateur', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, '2000-01-01 00:00:00');

-- --------------------------------------------------------
-- Tables supplémentaires (patient, rendezvous, prescription, vente, paiement, commande)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `patient`;
CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT '',
  `adresse` varchar(255) DEFAULT '',
  `mutuelle` varchar(100) DEFAULT '',
  `note` text,
  `cree_le` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `rendezvous`;
CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `date_rdv` date NOT NULL,
  `heure_rdv` time NOT NULL,
  `motif` varchar(255) DEFAULT '',
  `statut` enum('en_attente','confirme','annule','termine') NOT NULL DEFAULT 'en_attente',
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE `prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `date_prescription` date NOT NULL,
  `od_sphere` decimal(5,2) DEFAULT 0.00,
  `od_cylindre` decimal(5,2) DEFAULT 0.00,
  `od_axe` int(3) DEFAULT 0,
  `og_sphere` decimal(5,2) DEFAULT 0.00,
  `og_cylindre` decimal(5,2) DEFAULT 0.00,
  `og_axe` int(3) DEFAULT 0,
  `addition` decimal(5,2) DEFAULT 0.00,
  `opticien_id` int(11) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `vente`;
CREATE TABLE `vente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `date_vente` date NOT NULL,
  `montant_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `montant_paye` decimal(10,2) NOT NULL DEFAULT 0.00,
  `statut` enum('impaye','partiel','paye') NOT NULL DEFAULT 'impaye',
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE `paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vente_id` int(11) NOT NULL,
  `date_paiement` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `mode` enum('especes','carte','cheque','mutuelle','virement') NOT NULL DEFAULT 'especes',
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `commande`;
CREATE TABLE `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fournisseur_id` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `statut` enum('en_attente','recue','annulee') NOT NULL DEFAULT 'en_attente',
  `montant_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `commande_detail`;
CREATE TABLE `commande_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(11) NOT NULL,
  `type_produit` enum('monture','verre','lentille') NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  `prix_unitaire` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `vente_detail`;
CREATE TABLE `vente_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vente_id` int(11) NOT NULL,
  `type_produit` enum('monture','verre','lentille') NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  `prix_unitaire` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mouvement_stock`;
CREATE TABLE `mouvement_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_produit` enum('monture','verre','lentille') NOT NULL,
  `produit_id` int(11) NOT NULL,
  `type_mouvement` enum('entree','sortie') NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_mouvement` date NOT NULL,
  `motif` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
