-- mvcdocker2.esgi_checkout definition

CREATE TABLE `esgi_checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `createdAt` timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updatedAt` timestamp on update CURRENT_TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `esgi_checkout_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `esgi_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;


-- mvcdocker2.esgi_checkout_product definition

CREATE TABLE `esgi_checkout_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_checkout` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_checkout` (`id_checkout`),
  CONSTRAINT `esgi_checkout_product_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES `esgi_checkout` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;