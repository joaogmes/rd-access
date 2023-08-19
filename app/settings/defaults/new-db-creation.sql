-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.34-0ubuntu0.22.04.1 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para RdAccessTerminal
DROP DATABASE IF EXISTS `RdAccessTerminal`;
CREATE DATABASE IF NOT EXISTS `RdAccessTerminal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `RdAccessTerminal`;

-- Copiando estrutura para tabela RdAccessTerminal.Access
DROP TABLE IF EXISTS `Access`;
CREATE TABLE IF NOT EXISTS `Access` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `macAddress` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `authorization` bigint unsigned DEFAULT NULL,
  `code` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `macAddress` (`macAddress`),
  KEY `authorization` (`authorization`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela RdAccessTerminal.Authorization
CREATE TABLE IF NOT EXISTS `Authorization` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket` varchar(250) DEFAULT NULL,
  `type` enum('allow','deny') DEFAULT 'allow',
  `codeCore` varchar(250) DEFAULT NULL,
  `codePrefix` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codeSuffix` varchar(250) DEFAULT NULL,
  `rangeStart` int DEFAULT NULL,
  `rangeEnd` int DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela RdAccessTerminal.Config
CREATE TABLE IF NOT EXISTS `Config` (
  `macAddress` varchar(250) NOT NULL,
  `event` int unsigned NOT NULL DEFAULT '0',
  `authMode` enum('free','ticket') DEFAULT 'ticket',
  `operationalMode` enum('in','out','both') DEFAULT 'in',
  `status` enum('active','inactive') DEFAULT 'inactive',
  `creationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`macAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela RdAccessTerminal.GlobalAccess
CREATE TABLE IF NOT EXISTS `GlobalAccess` (
  `code` varchar(250) NOT NULL,
  `authorization` varchar(250) DEFAULT NULL,
  `macAddress` varchar(250) DEFAULT NULL,
  `accessId` int DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela RdAccessTerminal.Log
CREATE TABLE IF NOT EXISTS `Log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `event` json NOT NULL,
  `exception` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
