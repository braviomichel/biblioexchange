-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 14 avr. 2024 à 15:30
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
  `année_de_publication` varchar(4) NOT NULL,
  `couverture` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `owner_id` int NOT NULL,
  `categorie` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_livre`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id_livre`, `titre_livre`, `auteur`, `année_de_publication`, `couverture`, `owner_id`, `categorie`) VALUES
(5, 'pierre et sa bella', 'eores dicaprio', '2012', '‪+229 67 06 95 64‬ 20180728_002101.jpg', 34, ''),
(6, 'La guerre des mondes', 'Bruno Tertrais', '2022', 'la guerre des mondes.jpeg', 34, 'Biographie'),
(7, 'Dans l\'ombre du pouvoir', 'Frédéric Turpin', '2015', 'Dans l\'ombre du pouvoir.jpg', 34, ''),
(9, 'Le temps des tempêtes', 'Nicolas SARKOZY', '2019', 'Le temps des tempetes.jpeg', 34, ''),
(10, 'Le temps des COMBATS', 'Nicolas SARKOZY', '2023', 'Le temps des combats.jpg', 34, ''),
(11, 'Hambak une vie', 'Dr Jean-Jacques KONADJE', '2022', 'hAMBAK UNE VIE.jpg', 34, ''),
(12, 'Mensuel Jeune Afrique', 'Jeune Afrique', '2024', 'magazine4.png', 34, ''),
(13, 'Blue lock', 'shonen', '2022', 'bio4.jpg', 34, 'Géopolitique');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_emetteur` int NOT NULL,
  `id_recepteur` int NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

DROP TABLE IF EXISTS `signalement`;
CREATE TABLE IF NOT EXISTS `signalement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `date_time` datetime NOT NULL,
  `raison` text NOT NULL,
  `statut` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `signalement`
--

INSERT INTO `signalement` (`id`, `id_utilisateur`, `date_time`, `raison`, `statut`) VALUES
(1, 34, '2024-04-12 15:42:36', 'Le livre de Naruto est une fraude', 'Traité');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id_transaction` int NOT NULL AUTO_INCREMENT,
  `id_emetteur` int NOT NULL,
  `id_recepteur` int NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `session_id`, `user_id`) VALUES
(47, '1c95d227555811e85e71df9b0d0abf60a355abefae2a9ee2af76b3ddb3dc30a7', 35),
(48, '8128d9e0e145058c48b122b31fd27af6766f61001117de1f5e38900c00b2c080', 34),
(49, '66c888d69bfb76bfe9178dba6ec326cf31f16cc782668beee6415e344d87fa27', 34),
(50, 'e033db3765a5a4bc318940696833a01999da0a638b1305844c7e125af53b2eeb', 39),
(51, '48c0cc3375380fea2531c60d3fcf4b6189afe5a35d5915919dbb6932dac7777a', 39),
(52, 'f5dde200a083a17796e8d5ba2172b3a998aa00e56fc13a6841d34fa91bc3bfd5', 39),
(65, '46e6da3a55354371258499c1ab2f6107bbbd808d9ccc6d29fe44c5cb4cd29007', 34);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `email`, `mot_de_passe`, `date_naissance`, `telephone`, `sexe`, `niveau_etude`, `biographie`, `genre_prefere`, `image_profil`, `role_utilisateur`) VALUES
(34, 'user', 'user', 'user@gmail.com', '$2y$12$6B6BVUk9ZegbEqx1gU2Y7.O8BhGqya/x5o8rWtjBbqdsRSAvIioey', '2021-10-12', '0645372875', 'homme', 'universitaire', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaa', 'a:2:{i:0;s:7:\"fiction\";i:1;s:15:\"romanHistorique\";}', 'book1.jpg', 'user'),
(35, 'ESSOU', 'Pierre Canisius Pax', 'admin@gmail.com', '$2y$12$yOypcjtBuJAqkybzeaA9DunGe2NTdyKWLImuzYmf.6OOAM9.uq17y', '2001-12-21', '0645372871', 'homme', 'universitaire', 'Etudiant, Passionné de Basket et de belles créatures', 'a:4:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";i:2;s:11:\"fantastique\";i:3;s:6:\"poesie\";}', '', 'admin'),
(37, 'toto', 'tata', 'toto@user.com', '$2y$12$dttzOlpuhv.luliaQxVi/uwDvAM9cI5VIwYHQUvW31hIj/ZuWKW5G', '2024-04-04', '0645372871', 'homme', 'primaire', 'qqlsdnlqslkdqs,dmqsdqsdqsdqsdqsdqsdqs qdqsdqsdqsdqsddqdsqd', 'a:2:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";}', 'avatar1.png', 'user'),
(40, 'Lionel', 'ANANI', 'charbelazon23@gmail.com', '$2y$12$bq9A8PFBlt5zU0rQE5yoo.S4D429ueuyjvLv12FvHVHAOQoarvyxS', '2024-04-18', '0681572736', 'homme', 'primaire', 'joie', 'a:2:{i:0;s:14:\"scienceFiction\";i:1;s:11:\"fantastique\";}', 'avatar1.png', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
