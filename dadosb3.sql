CREATE DATABASE IF NOT EXISTS `dadosb3`;
USE `dadosb3`;

CREATE TABLE IF NOT EXISTS `dados_b3` (
  `id_open_position` int NOT NULL AUTO_INCREMENT,
  `RptDt` datetime DEFAULT NULL,
  `TckrSymb` varchar(255) DEFAULT NULL,
  `Asst` varchar(255) DEFAULT NULL,
  `BalQty` bigint DEFAULT NULL,
  `TradAvrgPric` float DEFAULT NULL,
  `PricFctr` int DEFAULT NULL,
  `BalVal` double DEFAULT NULL,
  PRIMARY KEY (`id_open_position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
