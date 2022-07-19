SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `esgi_role`;
CREATE TABLE IF NOT EXISTS `esgi_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;


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


ALTER TABLE `esgi_page`
  ADD PRIMARY KEY (`id`);
  

ALTER TABLE `esgi_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;



ALTER TABLE `esgi_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `esgi_user`
ADD FOREIGN KEY (`id_role`) REFERENCES `esgi_role`(`id`);

ALTER TABLE `esgi_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;



CREATE TABLE mvcdocker2.esgi_comment (
    id INT auto_increment NOT NULL,
    id_page INT NOT NULL,
    id_user INT NOT NULL,
    content MEDIUMTEXT NOT NULL,
    verified TINYINT NOT NULL,
    createdAt timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updatedAt timestamp on update CURRENT_TIMESTAMP NULL,
    reported TINYINT NOT NULL,
     PRIMARY KEY (`id`),
     FOREIGN KEY (`id_page`) REFERENCES `esgi_page`(`id`),
     FOREIGN KEY (`id_user`) REFERENCES `esgi_user`(`id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci;


-------------------


CREATE TABLE mvcdocker2.esgi_product (
  `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  `name` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


----------------------





CREATE TABLE `esgi_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1,
  `name` varchar(50) NOT NULL,
  `color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


----------------------------


CREATE TABLE `esgi_checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `createdAt` timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updatedAt` timestamp on update CURRENT_TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `esgi_checkout_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `esgi_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;



CREATE TABLE `esgi_checkout_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_checkout` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_checkout` (`id_checkout`),
  CONSTRAINT `esgi_checkout_product_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES `esgi_checkout` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;