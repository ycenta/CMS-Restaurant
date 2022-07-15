-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mer. 01 déc. 2021 à 11:57
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvcdocker2`
--

-- --------------------------------------------------------

--
-- Structure de la table `esgi_role`
--

DROP TABLE IF EXISTS `esgi_role`;
CREATE TABLE IF NOT EXISTS `esgi_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

--
-- Remplissage de la table role
--

INSERT INTO mvcdocker2.esgi_role
(id, name)
VALUES(1, 'user');
INSERT INTO mvcdocker2.esgi_role
(id, name)
VALUES(2, 'editor');
INSERT INTO mvcdocker2.esgi_role
(id, name)
VALUES(3, 'admin');

--
-- Structure de la table `esgi_user`
--

CREATE TABLE `esgi_user` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `id_role` int DEFAULT NULL,
  `token` char(255) DEFAULT NULL,
  `reset_token` char(255) DEFAULT NULL,
  `auth_token` char(255) DEFAULT NULL,
  `reset_token_expiration` timestamp NULL DEFAULT NULL,
  `token_expiration` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure de la table `esgi_page`
--

CREATE TABLE `esgi_page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour la table `esgi_page`
--
ALTER TABLE `esgi_page`
  ADD PRIMARY KEY (`id`);
  
--
-- AUTO_INCREMENT pour la table `esgi_page`
--
ALTER TABLE `esgi_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `esgi_user`
--
ALTER TABLE `esgi_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


--
-- Foreign key pour la table `esgi_user`
--
ALTER TABLE `esgi_user`
ADD FOREIGN KEY (`id_role`) REFERENCES `esgi_role`(`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `esgi_user`
--
ALTER TABLE `esgi_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Creation de la table esgi_comment
--

CREATE TABLE mvcdocker2.esgi_comment (
    id INT auto_increment NOT NULL,
    id_page INT NOT NULL,
    id_user INT NOT NULL,
    content MEDIUMTEXT NOT NULL,
    verified TINYINT NOT NULL,
    createdAt timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updatedAt timestamp on update CURRENT_TIMESTAMP NULL,
     PRIMARY KEY (`id`),
     FOREIGN KEY (`id_page`) REFERENCES `esgi_page`(`id`),
     FOREIGN KEY (`id_user`) REFERENCES `esgi_user`(`id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
