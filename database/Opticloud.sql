-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 09 Juin 2026 à 19:34
-- Version du serveur: 5.0.45
-- Version de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `opticloud`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idcategorie` varchar(10) NOT NULL,
  `nomcategorie` varchar(100) NOT NULL,
  PRIMARY KEY  (`idcategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idcategorie`, `nomcategorie`) VALUES
('CAT01', 'Lunettes de vue'),
('CAT02', 'Lunettes de soleil'),
('CAT03', 'Lentilles de contact'),
('CAT04', 'Accessoires'),
('CAT05', 'Produits d''entretien'),
('CAT06', 'Montures enfants'),
('CAT07', 'Montures femmes'),
('CAT08', 'Montures hommes');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL auto_increment,
  `fournisseur_id` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `statut` enum('en_attente','recue','annulee') NOT NULL default 'en_attente',
  `montant_total` decimal(10,2) NOT NULL default '0.00',
  `note` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commande`
--


-- --------------------------------------------------------

--
-- Structure de la table `commande_detail`
--

CREATE TABLE `commande_detail` (
  `id` int(11) NOT NULL auto_increment,
  `commande_id` int(11) NOT NULL,
  `type_produit` enum('monture','verre','lentille') NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL default '1',
  `prix_unitaire` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commande_detail`
--


-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `idfournisseur` int(11) NOT NULL auto_increment,
  `nom` varchar(100) default NULL,
  `responsable` varchar(100) default NULL,
  `adresse` varchar(200) default NULL,
  `ville` varchar(100) default NULL,
  `telephone` varchar(20) default NULL,
  `email` varchar(100) default NULL,
  PRIMARY KEY  (`idfournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`idfournisseur`, `nom`, `responsable`, `adresse`, `ville`, `telephone`, `email`) VALUES
(1, 'Optique Atlas', 'Ahmed Benali', '12 Avenue Hassan II', 'Casablanca', '0522123456', 'contact@optiqueatlas.ma'),
(2, 'Vision Tanger', 'Youssef El Idrissi', '45 Rue Mohammed V', 'Tanger', '0539932145', 'info@visiontanger.ma'),
(3, 'Optic Rabat', 'Karim Bennis', '8 Avenue Fal Ould Oumeir', 'Rabat', '0537765432', 'contact@opticrabat.ma'),
(4, 'Lunettes Agadir', 'Said Amrani', '21 Boulevard Hassan I', 'Agadir', '0528234567', 'service@lunettesagadir.ma'),
(5, 'Optique Fes', 'Hassan Fassi', '15 Rue Allal Ben Abdellah', 'Fes', '0535647382', 'contact@optiquefes.ma');

-- --------------------------------------------------------

--
-- Structure de la table `lentille`
--

CREATE TABLE `lentille` (
  `idlentille` varchar(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `idmarque` varchar(5) default NULL,
  `type` enum('journalière','hebdomadaire','mensuelle','annuelle') default NULL,
  `materiau` varchar(50) default NULL,
  `correction` enum('sphérique','torique','multifocale') default NULL,
  `couleur` varchar(50) default NULL,
  `diametre` decimal(4,1) default NULL,
  `rayon_courbure` decimal(4,2) default NULL,
  `puissance_min` decimal(5,2) default NULL,
  `puissance_max` decimal(5,2) default NULL,
  `prix` decimal(10,2) default NULL,
  `stock` int(11) default '0',
  `idfournisseur` int(11) default NULL,
  `description` varchar(255) default NULL,
  PRIMARY KEY  (`idlentille`),
  KEY `idmarque` (`idmarque`),
  KEY `idfournisseur` (`idfournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lentille`
--

INSERT INTO `lentille` (`idlentille`, `nom`, `idmarque`, `type`, `materiau`, `correction`, `couleur`, `diametre`, `rayon_courbure`, `puissance_min`, `puissance_max`, `prix`, `stock`, `idfournisseur`, `description`) VALUES
('LT001', 'Acuvue Oasys', 'CK', 'hebdomadaire', 'Silicone-hydrogel', 'sphérique', 'transparent', 14.0, 8.40, -6.00, 4.00, 180.00, 50, 1, 'Lentille haute respirabilité pour port prolongé'),
('LT002', 'Air Optix Night & Day', 'OK', 'mensuelle', 'Silicone-hydrogel', 'sphérique', 'bleu clair', 13.8, 8.60, -8.00, 6.00, 220.00, 40, 2, 'Lentille mensuelle autorisée pour le port nocturne'),
('LT003', 'Bausch Soflens Toric', 'RB', 'mensuelle', 'Hydrogel', 'torique', 'gris', 14.5, 8.50, -4.00, 2.00, 260.00, 30, 3, 'Lentille torique pour correction de l''astigmatisme'),
('LT004', 'Dailies Total 1', 'ES', 'journalière', 'Silicone-hydrogel', 'sphérique', 'transparent', 14.1, 8.50, -6.00, 3.00, 150.00, 60, 4, 'Lentille journalière ultra-confortable'),
('LT005', 'Biofinity Multifocal', 'HO', 'mensuelle', 'Silicone-hydrogel', 'multifocale', 'vert', 14.0, 8.60, -5.00, 3.00, 300.00, 25, 5, 'Lentille multifocale pour correction de la presbytie');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `idmarque` varchar(5) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `pays` varchar(100) default NULL,
  `description` varchar(255) default NULL,
  PRIMARY KEY  (`idmarque`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `marque`
--

INSERT INTO `marque` (`idmarque`, `nom`, `pays`, `description`) VALUES
('AD', 'Adidas', 'Allemagne', 'Marque sportive internationale'),
('BB', 'Burberry', 'Royaume-Uni', 'Marque britannique de mode et accessoires'),
('BV', 'Bvlgari', 'Italie', 'Maison de luxe italienne proposant des lunettes'),
('CH', 'Chanel', 'France', 'Maison de haute couture produisant des lunettes'),
('CK', 'Calvin Klein', 'USA', 'Marque de mode américaine minimaliste'),
('CR', 'Carrera', 'Autriche', 'Marque connue pour ses lunettes de soleil sport'),
('DG', 'Dolce & Gabbana', 'Italie', 'Marque de luxe italienne très populaire'),
('DR', 'Dior', 'France', 'Marque de luxe française avec lunettes élégantes'),
('EA', 'Emporio Armani', 'Italie', 'Ligne de mode Armani avec lunettes modernes'),
('ES', 'Essilor', 'France', 'Leader mondial des verres correcteurs'),
('GC', 'Gucci', 'Italie', 'Marque de luxe proposant des lunettes élégantes'),
('GU', 'Guess', 'USA', 'Marque de mode américaine avec lunettes tendance'),
('HB', 'Hugo Boss', 'Allemagne', 'Marque allemande de mode et lunettes'),
('HO', 'Hoya', 'Japon', 'Fabricant japonais de verres optiques'),
('LC', 'Lacoste', 'France', 'Marque française de sport et mode'),
('MB', 'Montblanc', 'Allemagne', 'Marque de luxe connue pour ses accessoires'),
('NK', 'Nikon', 'Japon', 'Marque connue pour les verres et instruments optiques'),
('OK', 'Oakley', 'USA', 'Marque spécialisée dans les lunettes sportives'),
('PL', 'Police', 'Italie', 'Marque de lunettes au style urbain'),
('PM', 'Puma', 'Allemagne', 'Marque sportive proposant lunettes et accessoires'),
('PR', 'Prada', 'Italie', 'Marque italienne de mode avec lunettes premium'),
('PS', 'Persol', 'Italie', 'Marque italienne de lunettes haut de gamme'),
('RB', 'Ray-Ban', 'Italie', 'Marque célèbre de lunettes de soleil et montures'),
('RD', 'Rodenstock', 'Allemagne', 'Fabricant allemand de verres et montures'),
('SH', 'Shamir', 'Israël', 'Fabricant international de verres ophtalmiques'),
('SK', 'Seiko', 'Japon', 'Marque japonaise produisant des verres optiques'),
('TF', 'Tom Ford', 'USA', 'Marque de mode produisant des lunettes de luxe'),
('TK', 'Tokai', 'Japon', 'Fabricant japonais de verres optiques'),
('VS', 'Versace', 'Italie', 'Marque de mode italienne de luxe'),
('ZE', 'Zeiss', 'Allemagne', 'Entreprise spécialisée en optique de précision');

-- --------------------------------------------------------

--
-- Structure de la table `monture`
--

CREATE TABLE `monture` (
  `idmonture` int(11) NOT NULL auto_increment,
  `reference` varchar(50) NOT NULL,
  `modele` varchar(100) default NULL,
  `couleur` varchar(50) default NULL,
  `materiau` varchar(50) default NULL,
  `genre` enum('homme','femme','enfant','mixte') default NULL,
  `prix` decimal(10,2) default NULL,
  `stock` int(11) default '0',
  `idmarque` varchar(10) default NULL,
  `idfournisseur` int(11) default NULL,
  `idcategorie` varchar(10) default NULL,
  `description` varchar(255) default NULL,
  PRIMARY KEY  (`idmonture`),
  KEY `idmarque` (`idmarque`),
  KEY `idfournisseur` (`idfournisseur`),
  KEY `idcategorie` (`idcategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `monture`
--

INSERT INTO `monture` (`idmonture`, `reference`, `modele`, `couleur`, `materiau`, `genre`, `prix`, `stock`, `idmarque`, `idfournisseur`, `idcategorie`, `description`) VALUES
(11, 'CH011', 'Paris Chic', 'Noir', 'Acétate', 'femme', 2800.00, 6, 'CH', 2, 'CAT07', 'Monture élégante inspirée de la mode parisienne'),
(12, 'TF012', 'Luxury Vision', 'Marron', 'Acétate', 'homme', 3200.00, 5, 'TF', 3, 'CAT08', 'Monture haut de gamme avec finition premium'),
(13, 'VS013', 'Golden Frame', 'Doré', 'Métal', 'femme', 3500.00, 3, 'VS', 1, 'CAT07', 'Monture luxe avec détails dorés'),
(14, 'AD014', 'Sport Active', 'Bleu/Noir', 'Plastique', 'homme', 1300.00, 14, 'AD', 5, 'CAT08', 'Monture sportive légère'),
(15, 'NK015', 'Optic Clear', 'Transparent', 'Plastique', 'mixte', 1700.00, 10, 'NK', 4, 'CAT01', 'Monture discrète et légère'),
(16, 'MB016', 'Executive Line', 'Gris foncé', 'Titane', 'homme', 2900.00, 7, 'MB', 3, 'CAT08', 'Monture élégante pour cadres'),
(17, 'PL017', 'Street Style', 'Noir mat', 'Plastique', 'mixte', 1500.00, 11, 'PL', 2, 'CAT01', 'Monture urbaine moderne'),
(18, 'PM018', 'Kids Sport', 'Vert', 'Plastique', 'enfant', 800.00, 18, 'PM', 5, 'CAT06', 'Monture résistante pour enfants actifs'),
(19, 'BV019', 'Italian Elegance', 'Bordeaux', 'Acétate', 'femme', 3100.00, 4, 'BV', 1, 'CAT07', 'Monture italienne élégante'),
(20, 'RD020', 'Precision Optic', 'Argent', 'Métal', 'homme', 2600.00, 6, 'RD', 3, 'CAT08', 'Monture précise et robuste');

-- --------------------------------------------------------

--
-- Structure de la table `mouvement_stock`
--

CREATE TABLE `mouvement_stock` (
  `id` int(11) NOT NULL auto_increment,
  `type_produit` enum('monture','verre','lentille') NOT NULL,
  `produit_id` int(11) NOT NULL,
  `type_mouvement` enum('entree','sortie') NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_mouvement` date NOT NULL,
  `motif` varchar(255) default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `mouvement_stock`
--


-- --------------------------------------------------------

--
-- Structure de la table `opticien`
--

CREATE TABLE `opticien` (
  `idopticien` int(11) NOT NULL,
  `nommagasin` varchar(150) NOT NULL,
  `responsable` varchar(100) default NULL,
  `telephone` varchar(20) default NULL,
  `email` varchar(100) default NULL,
  `adresse` varchar(200) default NULL,
  `ville` varchar(100) default NULL,
  `pays` varchar(100) default NULL,
  `dateinscription` date default NULL,
  `statut` varchar(20) default NULL,
  `license` varchar(100) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  PRIMARY KEY  (`idopticien`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `opticien`
--

INSERT INTO `opticien` (`idopticien`, `nommagasin`, `responsable`, `telephone`, `email`, `adresse`, `ville`, `pays`, `dateinscription`, `statut`, `license`, `motdepasse`) VALUES
(1, 'Optique Vision Plus', 'Ahmed Benali', '0612345678', 'contact@visionplus.ma', '12 Rue Hassan II', 'Casablanca', 'Maroc', '2024-01-10', 'actif', 'OC0-000-0000', ''),
(2, 'Optique Al Amal', 'Youssef El Idrissi', '0623456789', 'contact@alamal.ma', '45 Avenue Mohammed V', 'Rabat', 'Maroc', '2024-02-05', 'actif', 'LIC-OPT-1002', ''),
(3, 'Optique Atlas', 'Karim Bensalem', '0634567890', 'atlas@optique.ma', '8 Rue Atlas', 'Marrakech', 'Maroc', '2024-03-12', 'actif', 'LIC-OPT-1003', ''),
(4, 'Optique Sahara', 'Hassan Lahlou', '0645678901', 'sahara@optique.ma', '23 Boulevard Zerktouni', 'Agadir', 'Maroc', '2024-04-02', 'actif', 'LIC-OPT-1004', ''),
(5, 'Optique Rif', 'Mohamed El Amrani', '0656789012', 'rif@optique.ma', '10 Rue Tetouan', 'Tanger', 'Maroc', '2024-05-15', 'actif', 'LIC-OPT-1005', ''),
(6, 'Optique Lumière', 'Fatima Zahra', '0667890123', 'lumiere@optique.ma', '5 Avenue France', 'Fes', 'Maroc', '2024-06-20', 'actif', 'LIC-OPT-1006', ''),
(7, 'Optique Horizon', 'Abdelkader Chraibi', '0678901234', 'horizon@optique.ma', '19 Rue Oujda', 'Oujda', 'Maroc', '2024-07-18', 'actif', 'LIC-OPT-1007', ''),
(8, 'Optique Centrale', 'Samir Belkadi', '0689012345', 'centrale@optique.ma', '3 Boulevard Centre', 'Meknes', 'Maroc', '2024-08-09', 'actif', 'LIC-OPT-1008', ''),
(9, 'Optique Médina', 'Rachid El Fassi', '0690123456', 'medina@optique.ma', '14 Rue Médina', 'Tetouan', 'Maroc', '2024-09-01', 'actif', 'LIC-OPT-1009', ''),
(10, 'Optique Al Bassar', 'Nadia Karimi', '0601234567', 'bassar@optique.ma', '7 Avenue Hassan I', 'Kenitra', 'Maroc', '2024-10-11', 'actif', 'LIC-OPT-1010', '');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id` int(11) NOT NULL auto_increment,
  `vente_id` int(11) NOT NULL,
  `date_paiement` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `mode` enum('especes','carte','cheque','mutuelle','virement') NOT NULL default 'especes',
  `note` text,
  PRIMARY KEY  (`id`),
  KEY `vente_id` (`vente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `paiement`
--


-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL auto_increment,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(100) default '',
  `adresse` varchar(255) default '',
  `mutuelle` varchar(100) default '',
  `note` text,
  `cree_le` datetime NOT NULL default '2000-01-01 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `patient`
--


-- --------------------------------------------------------

--
-- Structure de la table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) NOT NULL,
  `date_prescription` date NOT NULL,
  `od_sphere` decimal(5,2) default '0.00',
  `od_cylindre` decimal(5,2) default '0.00',
  `od_axe` int(3) default '0',
  `og_sphere` decimal(5,2) default '0.00',
  `og_cylindre` decimal(5,2) default '0.00',
  `og_axe` int(3) default '0',
  `addition` decimal(5,2) default '0.00',
  `opticien_id` int(11) default NULL,
  `note` text,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `prescription`
--


-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) NOT NULL,
  `date_rdv` date NOT NULL,
  `heure_rdv` time NOT NULL,
  `motif` varchar(255) default '',
  `statut` enum('en_attente','confirme','annule','termine') NOT NULL default 'en_attente',
  `note` text,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `rendezvous`
--


-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL auto_increment,
  `nom` varchar(100) NOT NULL,
  `login` varchar(60) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','employe') NOT NULL default 'employe',
  `actif` tinyint(1) NOT NULL default '1',
  `cree_le` datetime NOT NULL default '2000-01-01 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `login`, `mot_de_passe`, `role`, `actif`, `cree_le`) VALUES
(1, 'Administrateur', 'admin', '4a7d1ed414474e4033ac29ccb8653d9b', 'admin', 1, '2000-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) NOT NULL,
  `date_vente` date NOT NULL,
  `montant_total` decimal(10,2) NOT NULL default '0.00',
  `montant_paye` decimal(10,2) NOT NULL default '0.00',
  `statut` enum('impaye','partiel','paye') NOT NULL default 'impaye',
  `note` text,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `vente`
--


-- --------------------------------------------------------

--
-- Structure de la table `vente_detail`
--

CREATE TABLE `vente_detail` (
  `id` int(11) NOT NULL auto_increment,
  `vente_id` int(11) NOT NULL,
  `type_produit` enum('monture','verre','lentille') NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL default '1',
  `prix_unitaire` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `vente_id` (`vente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `vente_detail`
--


-- --------------------------------------------------------

--
-- Structure de la table `verre`
--

CREATE TABLE `verre` (
  `idverre` varchar(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `type` varchar(50) default NULL,
  `indice` decimal(3,2) default NULL,
  `traitement` varchar(100) default NULL,
  `prix` decimal(10,2) default NULL,
  `idmarque` varchar(5) default NULL,
  `description` varchar(255) default NULL,
  `stock` int(11) NOT NULL default '0',
  PRIMARY KEY  (`idverre`),
  KEY `idmarque` (`idmarque`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `verre`
--

INSERT INTO `verre` (`idverre`, `nom`, `type`, `indice`, `traitement`, `prix`, `idmarque`, `description`, `stock`) VALUES
('ES18', 'Essilor Crizal', 'Progressif', 1.67, 'Antireflet', 950.00, 'ES', 'Verre progressif avec traitement Crizal', 0),
('ES19', 'Essilor EyeZen', 'Simple', 1.50, 'Antireflet', 400.00, 'ES', 'Verre pour usage numérique', 0),
('HO17', 'Hoya LifeStyle', 'Progressif', 1.60, 'Antireflet', 850.00, 'HO', 'Verre progressif personnalisé', 0),
('HO18', 'Hoya Sync', 'Simple', 1.50, 'Photochromique', 480.00, 'HO', 'Verre simple avec protection UV', 0),
('NK15', 'Nikon SeeMax', 'Simple', 1.50, 'Antireflet', 420.00, 'NK', 'Verre simple de qualité Nikon', 0),
('NK16', 'Nikon Presio', 'Progressif', 1.60, 'Antireflet', 880.00, 'NK', 'Verre progressif haute précision', 0),
('RD15', 'Rodenstock Perfection', 'Progressif', 1.67, 'Antireflet', 970.00, 'RD', 'Verre progressif premium', 0),
('RD16', 'Rodenstock Multigressif', 'Progressif', 1.67, 'Antireflet', 990.00, 'RD', 'Verre progressif avec adaptation rapide', 0),
('ZE18', 'Zeiss Individual', 'Progressif', 1.67, 'Antireflet', 1000.00, 'ZE', 'Verre progressif sur mesure', 0),
('ZE19', 'Zeiss DuraVision', 'Simple', 1.60, 'Antireflet', 520.00, 'ZE', 'Verre simple avec traitement durable', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `lentille`
--
ALTER TABLE `lentille`
  ADD CONSTRAINT `lentille_ibfk_1` FOREIGN KEY (`idmarque`) REFERENCES `marque` (`idmarque`),
  ADD CONSTRAINT `lentille_ibfk_2` FOREIGN KEY (`idfournisseur`) REFERENCES `fournisseur` (`idfournisseur`);

--
-- Contraintes pour la table `monture`
--
ALTER TABLE `monture`
  ADD CONSTRAINT `monture_ibfk_1` FOREIGN KEY (`idmarque`) REFERENCES `marque` (`idmarque`),
  ADD CONSTRAINT `monture_ibfk_2` FOREIGN KEY (`idfournisseur`) REFERENCES `fournisseur` (`idfournisseur`),
  ADD CONSTRAINT `monture_ibfk_3` FOREIGN KEY (`idcategorie`) REFERENCES `categorie` (`idcategorie`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`vente_id`) REFERENCES `vente` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `rendezvous_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vente_detail`
--
ALTER TABLE `vente_detail`
  ADD CONSTRAINT `vente_detail_ibfk_1` FOREIGN KEY (`vente_id`) REFERENCES `vente` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `verre`
--
ALTER TABLE `verre`
  ADD CONSTRAINT `verre_ibfk_1` FOREIGN KEY (`idmarque`) REFERENCES `marque` (`idmarque`);
