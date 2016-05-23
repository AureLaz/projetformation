-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 23 Mai 2016 à 14:45
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `formationm2l`
--

-- --------------------------------------------------------

--
-- Structure de la table `attente`
--

CREATE TABLE IF NOT EXISTS `attente` (
  `id_attente` int(11) NOT NULL AUTO_INCREMENT,
  `pk_salarie` int(11) NOT NULL,
  `pk_formation` int(11) NOT NULL,
  `validation` int(1) NOT NULL,
  PRIMARY KEY (`id_attente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `attente`
--

INSERT INTO `attente` (`id_attente`, `pk_salarie`, `pk_formation`, `validation`) VALUES
(1, 1, 2, 0),
(4, 1, 4, 1),
(5, 1, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE IF NOT EXISTS `formation` (
  `id_formation` int(11) NOT NULL AUTO_INCREMENT,
  `duree_formation` float DEFAULT NULL,
  `contenu_formation` varchar(200) DEFAULT NULL,
  `date_formation` date DEFAULT NULL,
  `nbHeures_formation` float DEFAULT NULL,
  `lieu_formation` varchar(50) DEFAULT NULL,
  `requis_formation` varchar(200) DEFAULT NULL,
  `id_prestataire` int(11) NOT NULL,
  `credit_formation` int(5) NOT NULL,
  PRIMARY KEY (`id_formation`),
  KEY `FK_formation_id_prestataire` (`id_prestataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `formation`
--

INSERT INTO `formation` (`id_formation`, `duree_formation`, `contenu_formation`, `date_formation`, `nbHeures_formation`, `lieu_formation`, `requis_formation`, `id_prestataire`, `credit_formation`) VALUES
(2, 5, 'Java', '2016-02-17', 35, 'ITIC Paris', 'Aucun', 1, 50),
(4, 4, 'PHP', '2016-02-26', 28, 'ITIC Paris', 'Aucun', 1, 150),
(5, 9, 'MYSQL', '2016-02-05', 63, 'ITIC Paris', 'Aucun', 1, 100);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE IF NOT EXISTS `participe` (
  `etat_formation` int(11) NOT NULL,
  `id_salarie` int(11) NOT NULL,
  `id_formation` int(11) NOT NULL,
  PRIMARY KEY (`id_salarie`,`id_formation`),
  KEY `FK_participe_id_formation` (`id_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prestataire`
--

CREATE TABLE IF NOT EXISTS `prestataire` (
  `id_prestataire` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prestataire` varchar(25) DEFAULT NULL,
  `prenom_prestataire` varchar(25) DEFAULT NULL,
  `adresse_prestataire` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_prestataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `prestataire`
--

INSERT INTO `prestataire` (`id_prestataire`, `nom_prestataire`, `prenom_prestataire`, `adresse_prestataire`) VALUES
(1, 'Yaouhedeou', 'Axelito', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

CREATE TABLE IF NOT EXISTS `salarie` (
  `id_salarie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_salarie` varchar(30) DEFAULT NULL,
  `prenom_salarie` varchar(35) DEFAULT NULL,
  `password_salarie` longtext,
  `credit_salarie` int(11) DEFAULT NULL,
  `jour_salarie` int(11) DEFAULT NULL,
  `rang_salarie` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_salarie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `salarie`
--

INSERT INTO `salarie` (`id_salarie`, `nom_salarie`, `prenom_salarie`, `password_salarie`, `credit_salarie`, `jour_salarie`, `rang_salarie`) VALUES
(1, 'LAZARO', 'aurelien', 'bceb368e7f2cb351af47298f32034f0587bbe4a6', 100, 15, 1),
(2, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 50000, 15, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_formation_id_prestataire` FOREIGN KEY (`id_prestataire`) REFERENCES `prestataire` (`id_prestataire`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `FK_participe_id_formation` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id_formation`),
  ADD CONSTRAINT `FK_participe_id_salarie` FOREIGN KEY (`id_salarie`) REFERENCES `salarie` (`id_salarie`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
