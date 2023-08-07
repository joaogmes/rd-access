ALTER TABLE
	`Access` CHANGE COLUMN `creationDate` `creationDate` DATETIME NULL DEFAULT NOW()
AFTER
	`code`;

ALTER TABLE
	`Authorization` CHANGE COLUMN `corePrefix` `codePrefix` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci'
AFTER
	`codeCore`;