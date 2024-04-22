-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 avr. 2024 à 16:40
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
-- Structure de la table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
CREATE TABLE IF NOT EXISTS `demandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int DEFAULT NULL,
  `id_livre` int DEFAULT NULL,
  `date_demande` datetime DEFAULT NULL,
  `etat` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `resume` text,
  `owner_id` int NOT NULL,
  `categorie` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_livre`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id_livre`, `titre_livre`, `auteur`, `année_de_publication`, `couverture`, `resume`, `owner_id`, `categorie`, `disponible`) VALUES
(20, 'Blue lock', 'Nomura YUSUKE', '2019', 'manga1.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 41, 'Mangas', 0),
(21, 'Devenir', 'Michelle OBAMA', '2018', 'bio4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 37, 'Biographie', 1),
(23, 'La FRANCE NOIRE ', 'Présence Africaine', '2010', 'geo3.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 34, 'Géopolitique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_emetteur` int NOT NULL,
  `id_recepteur` int NOT NULL,
  `mess` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dateMess` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `id_emetteur`, `id_recepteur`, `mess`, `dateMess`) VALUES
(4, 1, 2, 'Bonjour. Je suis interessé par ce livre.', NULL),
(3, 1, 2, 'Bonjour. Je suis interessé par ce livre.', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_emetteur` int NOT NULL,
  `id_recepteur` int NOT NULL,
  `Title` varchar(50) NOT NULL,
  `messages` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `id_emetteur`, `id_recepteur`, `Title`, `messages`, `date_time`) VALUES
(6, 37, 34, 'Nouvelle Demande d\'Echange', 'Vous venez de recevoir une demande d\'échange concernant votre livre La FRANCE NOIRE ', '2024-04-22'),
(7, 34, 37, 'Nouvelle Demande d\'Echange', 'Vous venez de recevoir une demande d\'échange concernant votre livre Devenir', '2024-04-22'),
(8, 37, 34, 'Nouvelle Demande d\'Echange', 'Vous venez de recevoir une demande d\'échange concernant votre livre La FRANCE NOIRE ', '2024-04-22');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `etape` int NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `session_id`, `user_id`) VALUES
(81, '92e6a9479322366a35f043ebf57f93a31e24b3d80f0881db13b8925bf84b969d', 37),
(80, '40fefe226ab6db5d0aa5cff4092d35dbff2ed3619a8b28bdf9ced539bc0f8d11', 34),
(79, '90a4047c7ce40e62c5f09199953d4f6fa718b6b94db238040c23c7486129a9f8', 34),
(83, 'ae99408b07ea8961bf04baba98e06d27fdf4840722aad9c77eae5d025778dc68', 34),
(84, '9cf3cf24eeb8eced13ec24164f59a3c9f7a73fe9aeeaf446c21172598f83d4b0', 37),
(87, '48d681e42f806a340e3cc2a4f670d6edf53fe5127c23b37d2f0eca6b2d099f92', 37),
(89, '9ee8d4eadd9c87fd52cba62c3990668667361153c7cc5701d4977220541a30dd', 37),
(90, '5c6e34bafb9f05f5134f6a03900591897fd18178193c28a48bb9b61a0d80670b', 34),
(92, '0d73a2c8ca6f7769e8596512edf1897b1a3d7d6ccd37c11a8d29a0a57d5e5831', 37),
(98, 'af5793610434f00610146ec65a87165d7bde4e2cdd2d85399144a9ba6b54dddc', 37),
(97, '1fab1c303d782697205e7c7fce09f39213ec05760c8a256c5438f7ff3ca0d3c0', 34);

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `email`, `mot_de_passe`, `date_naissance`, `telephone`, `sexe`, `niveau_etude`, `biographie`, `genre_prefere`, `image_profil`, `role_utilisateur`) VALUES
(34, 'John', 'Does', 'user@gmail.com', '$2y$12$6B6BVUk9ZegbEqx1gU2Y7.O8BhGqya/x5o8rWtjBbqdsRSAvIioey', '2021-10-12', '0645372875', 'homme', 'universitaire', 'JEU JOIE TRAVAIL', 'a:2:{i:0;s:7:\"fiction\";i:1;s:15:\"romanHistorique\";}', 'target.png', 'user'),
(35, 'ESSOU', 'Pierre Canisius Pax', 'admin@gmail.com', '$2y$12$yOypcjtBuJAqkybzeaA9DunGe2NTdyKWLImuzYmf.6OOAM9.uq17y', '2001-12-21', '0645372871', 'homme', 'universitaire', 'Etudiant, Passionné de Basket et de belles créatures', 'a:4:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";i:2;s:11:\"fantastique\";i:3;s:6:\"poesie\";}', '', 'admin'),
(37, 'Benjamin', 'Franklin', 'toto@user.com', '$2y$12$6B6BVUk9ZegbEqx1gU2Y7.O8BhGqya/x5o8rWtjBbqdsRSAvIioey', '2024-04-04', '0645372871', 'homme', 'primaire', 'qqlsdnlqslkdqs,dmqsdqsdqsdqsdqsdqsdqs qdqsdqsdqsdqsddqdsqd', 'a:2:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";}', 'ouidah.jpg', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
