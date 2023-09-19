use RdAccessTerminal;

-- ALTER TABLE
-- 	`Access` CHANGE COLUMN `creationDate` `creationDate` DATETIME NULL DEFAULT NOW()
-- AFTER
-- 	`code`;

-- ALTER TABLE
-- 	`Authorization` CHANGE COLUMN `corePrefix` `codePrefix` VARCHAR(250) NULL DEFAULT NULL
-- AFTER
-- 	`codeCore`;

-- ALTER TABLE
-- 	`Config`
-- ADD
-- 	COLUMN `event` INT UNSIGNED NOT NULL DEFAULT 0
-- AFTER
-- 	`macAddress`;

CREATE TABLE IF NOT EXISTS `Log` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`event` JSON NOT NULL,
	`exception` TEXT NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
) COLLATE = 'utf8mb4_0900_ai_ci' ENGINE = InnoDB;

ALTER TABLE
	`Authorization`
ADD
	COLUMN `authType` ENUM('normal', 'master') NOT NULL DEFAULT 'normal'
AFTER
	`codeSuffix`;