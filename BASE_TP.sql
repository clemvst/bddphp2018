-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 03 Janvier 2019 à 14:13
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `BASE_TP`
--

-- --------------------------------------------------------

--
-- Structure de la table `CLIENTS`
--

CREATE TABLE `CLIENTS` (
  `AdresseMail` varchar(13) NOT NULL,
  `MotDePasse` varchar(4) DEFAULT NULL,
  `Nom` varchar(7) DEFAULT NULL,
  `Prenom` varchar(7) DEFAULT NULL,
  `Adresse` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `CLIENTS`
--

INSERT INTO `CLIENTS` (`AdresseMail`, `MotDePasse`, `Nom`, `Prenom`, `Adresse`) VALUES
('Claire@tp.bd', 'MNOP', 'Selona', 'Claire', 'Ad_Claire'),
('Eric@tp.bd', 'QRST', 'Davin', 'Eric', 'Ad_Eric'),
('Laurent@tp.bd', 'ABCD', 'Tournin', 'Laurent', 'Ad_Laurent'),
('Marie@tp.bd', 'IJKL', 'Davin', 'Marie', 'Ad_Marie'),
('Pierre@tp.bd', 'EFGH', 'Biret', 'Pierre', 'Ad_Pierre');

-- --------------------------------------------------------

--
-- Structure de la table `COMMANDES`
--

CREATE TABLE `COMMANDES` (
  `NumeroCommande` int(1) NOT NULL,
  `DateCommande` varchar(10) DEFAULT NULL,
  `ModePaiement` varchar(6) DEFAULT NULL,
  `DateExpedition` varchar(10) DEFAULT NULL,
  `AdresseMail` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `COMMANDES`
--

INSERT INTO `COMMANDES` (`NumeroCommande`, `DateCommande`, `ModePaiement`, `DateExpedition`, `AdresseMail`) VALUES
(1, '2018-11-03', 'Chèque', '2018-11-04', 'Claire@tp.bd'),
(2, '2018-11-03', 'CB', '2018-11-04', 'Marie@tp.bd'),
(3, '2018-11-04', 'CB', '2018-11-05', 'Laurent@tp.bd'),
(4, '2018-11-04', 'Espèce', '2018-11-06', 'Pierre@tp.bd'),
(5, '2018-11-05', 'CB', '2018-11-05', 'Laurent@tp.bd'),
(6, '2018-11-05', 'CB', '2018-11-08', 'Eric@tp.bd');

-- --------------------------------------------------------

--
-- Structure de la table `DETAIL`
--

CREATE TABLE `DETAIL` (
  `NumeroCommande` int(1) NOT NULL,
  `Reference` int(1) NOT NULL,
  `Quantite` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `DETAIL`
--

INSERT INTO `DETAIL` (`NumeroCommande`, `Reference`, `Quantite`) VALUES
(1, 5, 2),
(1, 6, 1),
(2, 2, 2),
(2, 6, 1),
(3, 1, 1),
(3, 3, 2),
(3, 6, 1),
(4, 1, 2),
(4, 4, 3),
(4, 5, 2),
(4, 6, 1),
(5, 1, 2),
(5, 2, 1),
(5, 3, 6),
(6, 1, 5),
(6, 5, 10),
(6, 6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `PRODUIT`
--

CREATE TABLE `PRODUIT` (
  `Reference` int(1) NOT NULL,
  `Nom` varchar(16) DEFAULT NULL,
  `Categorie` varchar(7) DEFAULT NULL,
  `Marque` varchar(7) DEFAULT NULL,
  `PrixUnitaire` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `PRODUIT`
--

INSERT INTO `PRODUIT` (`Reference`, `Nom`, `Categorie`, `Marque`, `PrixUnitaire`) VALUES
(1, 'YaVi', 'Yaourt', 'Villane', '3.49'),
(2, 'YaVi allégé', 'Yaourt', 'Villane', '3.99'),
(3, 'Lait demi-écrémé', 'Lait', 'Villane', '0.80'),
(4, 'Lait entier', 'Lait', 'Mirad', '0.75'),
(5, 'Le moelleux', 'Fromage', 'Mirad', '4.65'),
(6, 'Beurre doux', 'Beurre', 'Salic', '2.30');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `CLIENTS`
--
ALTER TABLE `CLIENTS`
  ADD PRIMARY KEY (`AdresseMail`);

--
-- Index pour la table `COMMANDES`
--
ALTER TABLE `COMMANDES`
  ADD PRIMARY KEY (`NumeroCommande`);

--
-- Index pour la table `DETAIL`
--
ALTER TABLE `DETAIL`
  ADD PRIMARY KEY (`NumeroCommande`,`Reference`);

--
-- Index pour la table `PRODUIT`
--
ALTER TABLE `PRODUIT`
  ADD PRIMARY KEY (`Reference`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
