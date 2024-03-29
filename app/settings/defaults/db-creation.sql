CREATE database IF NOT EXISTS RdAccessTerminal;

use RdAccessTerminal;

CREATE TABLE IF NOT EXISTS `Config` (
    `macAddress` varchar(20) PRIMARY KEY,
    `authMode` enum('free', 'ticket') DEFAULT 'ticket',
    `operationalMode` enum('in', 'out', 'both') DEFAULT 'in',
    `status` enum('active', 'inactive') DEFAULT 'inactive',
    `creationDate` datetime DEFAULT NOW(),
    `updateDate` datetime DEFAULT null ON UPDATE NOW()
);

CREATE TABLE IF NOT EXISTS `Authorization` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ticket` varchar(250),
    `type` enum('allow', 'deny') DEFAULT 'allow',
    `codeCore` varchar(250),
    `corePrefix` varchar(250),
    `codeSuffix` varchar(250),
    `rangeStart` int,
    `rangeEnd` int,
    `creationDate` datetime,
    `updateDate` datetime
);

CREATE TABLE IF NOT EXISTS `Access` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `macAddress` varchar(20),
    `authorization` BIGINT UNSIGNED,
    `code` varchar(100) UNIQUE,
    `creationDate` datetime
);

CREATE TABLE IF NOT EXISTS `GlobalAccess` (
    `code` varchar(100) PRIMARY KEY,
    `authorization` varchar(250),
    `macAddress` varchar(250),
    `accessId` int,
    `creationDate` datetime
);

ALTER TABLE
    `Access`
ADD
    FOREIGN KEY (`macAddress`) REFERENCES `Config` (`macAddress`);

ALTER TABLE
    `Access`
ADD
    FOREIGN KEY (`authorization`) REFERENCES `Authorization` (`id`);