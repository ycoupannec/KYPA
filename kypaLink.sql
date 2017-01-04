-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 04 Janvier 2017 à 10:19
-- Version du serveur :  5.6.28-0ubuntu0.15.04.1
-- Version de PHP :  5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `yohannc`
--

-- --------------------------------------------------------

--
-- Structure de la table `kypaLink`
--

CREATE TABLE IF NOT EXISTS `kypaLink` (
`ID` int(11) NOT NULL,
  `idDossier` varchar(30) NOT NULL,
  `mailEmetteur` varchar(30) NOT NULL,
  `mailRecepteur` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `dateUpload` date NOT NULL,
  `nbDay` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `kypaLink`
--

INSERT INTO `kypaLink` (`ID`, `idDossier`, `mailEmetteur`, `mailRecepteur`, `message`, `dateUpload`, `nbDay`) VALUES
(1, 'idDossier', 'mailEmetteur', 'mailRecepteur', '', '0000-00-00', 0),
(2, '586bc41a1d16e', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0),
(3, '586bc42ccc1cd', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0),
(4, '586bc69d393a8', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0),
(5, '586bc7076ec6e', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0),
(6, '586bc7755aaa3', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0),
(7, '586bc9d7c8c44', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0),
(8, '586bca6105a9d', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0),
(9, '586bcb9f29a89', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0),
(10, '586bd20ad3c5f', 'yohann.coupannec@gmail.com', 'yoh@oo.fr', '', '0000-00-00', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `kypaLink`
--
ALTER TABLE `kypaLink`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `kypaLink`
--
ALTER TABLE `kypaLink`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
