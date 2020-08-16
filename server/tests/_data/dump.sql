DROP TABLE IF EXISTS `pubs`;
CREATE TABLE `pubs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `playing_music` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `love_music` int NOT NULL,
  `location` int NOT NULL,
  `pub_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clients_pub_id_pubs_id` (`pub_id`),
  CONSTRAINT `fk_clients_pub_id_pubs_id` FOREIGN KEY (`pub_id`) REFERENCES `pubs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pubs`(`id`,`name`,`playing_music`) VALUES (1, 'Пинта', 1);
INSERT INTO `clients`(`id`,`name`,`love_music`,`location`,`pub_id`) VALUES 
    (1, 'test1', 1, 2, 1),(2, 'test2', 1, 2, 1),(3, 'test3', 1, 2, 1),(4, 'test4', 2, 1, 1),(5, 'test5', 2, 1, 1),
    (6, 'test6', 3, 1, 1),(7, 'test7', 3, 1, 1),(8, 'test8', 4, 1, 1),(9, 'test9', 5, 1, 1),(10, 'test10', 5, 1, 1);
