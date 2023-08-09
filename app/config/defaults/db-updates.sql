use RdAccessTerminal;

ALTER TABLE
	`Access` CHANGE COLUMN `creationDate` `creationDate` DATETIME NULL DEFAULT NOW()
AFTER
	`code`;

ALTER TABLE
	`Authorization` CHANGE COLUMN `corePrefix` `codePrefix` VARCHAR(250) NULL DEFAULT NULL
AFTER
	`codeCore`;