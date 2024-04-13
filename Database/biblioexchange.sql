-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 07 avr. 2024 à 20:16
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `biblioexchange`
--

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `id_livre` int NOT NULL AUTO_INCREMENT,
  `titre_livre` varchar(100) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `année_de_publication` date NOT NULL,
  PRIMARY KEY (`id_livre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id_transaction` int NOT NULL AUTO_INCREMENT,
  `nom_emetteur` varchar(100) NOT NULL,
  `nom_recepteur` varchar(100) NOT NULL,
  `id_livre` int NOT NULL,
  `date-transaction` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre_livre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_transaction`),
  KEY `id_livre` (`id_livre`),
  KEY `id_livre_2` (`id_livre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_id` (`session_id`,`user_id`),
  UNIQUE KEY `session_id_2` (`session_id`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(30) NOT NULL,
  `prenom_utilisateur` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mot_de_passe` text NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `niveau_etude` varchar(20) NOT NULL,
  `biographie` text NOT NULL,
  `genre_prefere` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `image_profil` varchar(100) NOT NULL,
  `role_utilisateur` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `email`, `mot_de_passe`, `date_naissance`, `telephone`, `sexe`, `niveau_etude`, `biographie`, `genre_prefere`, `image_profil`, `role_utilisateur`) VALUES
(34, 'user', 'user', 'user@gmail.com', '$2y$12$yc6BBUz6c6/kdronEcfo5.wYuDTp2H66Mdfaylt9nrIJ2WN9Dr0fK', '2021-10-12', '0645372875', 'homme', 'universitaire', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaa', 'a:2:{i:0;s:7:\"fiction\";i:1;s:15:\"romanHistorique\";}', 'wbs.png', 'user'),
(35, 'ESSOU', 'Pierre Canisius Pax', 'admin@gmail.com', '$2y$12$yOypcjtBuJAqkybzeaA9DunGe2NTdyKWLImuzYmf.6OOAM9.uq17y', '2001-12-21', '0645372871', 'homme', 'universitaire', 'Etudiant, Passionné de Basket et de belles créatures', 'a:4:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";i:2;s:11:\"fantastique\";i:3;s:6:\"poesie\";}', '', 'admin'),
(37, 'toto', 'tata', 'toto@user.com', '$2y$12$dttzOlpuhv.luliaQxVi/uwDvAM9cI5VIwYHQUvW31hIj/ZuWKW5G', '2024-04-04', '0645372871', 'homme', 'primaire', 'qqlsdnlqslkdqs,dmqsdqsdqsdqsdqsdqsdqs qdqsdqsdqsdqsddqdsqd', 'a:2:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";}', 'avatar1.png', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
