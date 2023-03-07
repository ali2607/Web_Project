-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 07 mars 2023 à 22:00
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Official_Bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `_jeu`
--

CREATE TABLE `_jeu` (
  `idJeu` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_score`
--

CREATE TABLE `_score` (
  `idUser` int(11) NOT NULL,
  `idJeu` int(11) NOT NULL,
  `personalBest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_user`
--

CREATE TABLE `_user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `_user`
--

INSERT INTO `_user` (`idUser`, `username`, `password`) VALUES
(1, 'er', 'er');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `_jeu`
--
ALTER TABLE `_jeu`
  ADD PRIMARY KEY (`idJeu`);

--
-- Index pour la table `_score`
--
ALTER TABLE `_score`
  ADD PRIMARY KEY (`idUser`,`idJeu`),
  ADD KEY `idJeu` (`idJeu`);

--
-- Index pour la table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `_user`
--
ALTER TABLE `_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `_score`
--
ALTER TABLE `_score`
  ADD CONSTRAINT `_score_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`),
  ADD CONSTRAINT `_score_ibfk_2` FOREIGN KEY (`idJeu`) REFERENCES `_jeu` (`idJeu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
