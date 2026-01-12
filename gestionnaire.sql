CREATE DATABASE IF NOT EXISTS `gestionnaire` 
CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `gestionnaire`;

CREATE TABLE `taches` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `decription` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;