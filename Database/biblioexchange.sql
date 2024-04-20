-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 18 avr. 2024 à 02:47
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
  `resume` text,
  `owner_id` int NOT NULL,
  `categorie` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_livre`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id_livre`, `titre_livre`, `auteur`, `année_de_publication`, `couverture`, `resume`, `owner_id`, `categorie`, `disponible`) VALUES
(6, 'La guerre des mondes', 'Bruno Tertrais', '2022', 'la guerre des mondes.jpeg', NULL, 34, 'Biographie', 1),
(7, 'Dans l\'ombre du pouvoir', 'Frédéric Turpin', '2015', 'Dans l\'ombre du pouvoir.jpg', NULL, 34, '', 1),
(9, 'Le temps des tempêtes', 'Nicolas SARKOZY', '2019', 'Le temps des tempetes.jpeg', NULL, 34, '', 1),
(10, 'Le temps des COMBATS', 'Nicolas SARKOZY', '2023', 'Le temps des combats.jpg', NULL, 34, '', 1),
(11, 'Hambak une vie', 'Dr Jean-Jacques KONADJE', '2022', 'hAMBAK UNE VIE.jpg', NULL, 34, '', 1),
(12, 'Mensuel Jeune Afrique', 'Jeune Afrique', '2024', 'magazine4.png', NULL, 34, '', 1),
(16, 'Odysée', 'Homère', '1924', 'odysee.jpg', 'L\'Odyssée\" est l\'une des œuvres les plus célèbres de la littérature grecque antique. Elle raconte le voyage épique d\'Ulysse (ou Odysseus en grec) alors qu\'il tente de retourner chez lui après la guerre de Troie. Son périple dure dix ans, au cours desquels il affronte de nombreux obstacles et dangers, tout en étant confronté à des épreuves divines orchestrées par les dieux de l\'Olympe.\r\n\r\nAprès la guerre de Troie, Ulysse et ses hommes entament leur retour vers Ithaque, son royaume. Cependant, en raison de la colère de Poséidon, dieu de la mer, Ulysse est confronté à de nombreuses difficultés. Il doit affronter des monstres redoutables, tels que le Cyclope Polyphème et la sorcière Circé, qui les transforment en porcs. Ulysse rencontre également les sirènes, des créatures séduisantes dont le chant peut conduire les marins à leur perte.\r\n\r\nPendant ce temps, à Ithaque, la femme d\'Ulysse, Pénélope, et leur fils, Télémaque, font face à des prétendants qui cherchent à épouser Pénélope et à prendre le contrôle du royaume. Mais Pénélope, fidèle à son époux disparu, tisse et défait chaque jour une tapisserie, promettant de choisir un prétendant une fois son ouvrage terminé.\r\n\r\nFinalement, avec l\'aide d\'Athéna et de son fils Télémaque, Ulysse parvient à rentrer chez lui. Déguisé en mendiant, il entreprend de reconquérir son royaume et de se venger des prétendants. Avec l\'aide de Télémaque et de quelques serviteurs fidèles, il massacre les prétendants et rétablit l\'ordre à Ithaque.\r\n\r\n\"L\'Odyssée\" est un récit rempli d\'aventures, de ruses, de personnages mythiques et de leçons sur la loyauté, la persévérance et le courage.', 34, 'Thriller', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(65, '46e6da3a55354371258499c1ab2f6107bbbd808d9ccc6d29fe44c5cb4cd29007', 34),
(69, '6eb5fb9fae7694c1741db8a616b9fb2a67b0807dfb968f463aae057180268fd1', 41),
(77, '1452970d882b7103c7649e7567386fed19cb20053c6775a947b429c296dc74dc', 34);

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
(34, 'user', 'user', 'user@gmail.com', '$2y$12$6B6BVUk9ZegbEqx1gU2Y7.O8BhGqya/x5o8rWtjBbqdsRSAvIioey', '2021-10-12', '0645372875', 'homme', 'universitaire', 'JEU JOIE TRAVAIL', 'a:2:{i:0;s:7:\"fiction\";i:1;s:15:\"romanHistorique\";}', 'BiblioExchange.png', 'user'),
(35, 'ESSOU', 'Pierre Canisius Pax', 'admin@gmail.com', '$2y$12$yOypcjtBuJAqkybzeaA9DunGe2NTdyKWLImuzYmf.6OOAM9.uq17y', '2001-12-21', '0645372871', 'homme', 'universitaire', 'Etudiant, Passionné de Basket et de belles créatures', 'a:4:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";i:2;s:11:\"fantastique\";i:3;s:6:\"poesie\";}', '', 'admin'),
(37, 'toto', 'tata', 'toto@user.com', '$2y$12$dttzOlpuhv.luliaQxVi/uwDvAM9cI5VIwYHQUvW31hIj/ZuWKW5G', '2024-04-04', '0645372871', 'homme', 'primaire', 'qqlsdnlqslkdqs,dmqsdqsdqsdqsdqsdqsdqs qdqsdqsdqsdqsddqdsqd', 'a:2:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";}', 'avatar1.png', 'user'),
(41, 'Lionel', 'ANANI', 'charbelazon23@gmail.com', '$2y$12$ZMCuPEtasuAq6UdMQDE8ROBNWZwnnBb5vyKbufmweUJxk7b5vLeou', '2024-04-24', '0681572736', 'homme', 'primaire', 'joie', 'a:2:{i:0;s:7:\"fiction\";i:1;s:14:\"scienceFiction\";}', 'avatar1.png', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
