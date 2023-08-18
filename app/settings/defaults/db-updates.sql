use RdAccessTerminal;

ALTER TABLE
	`Access` CHANGE COLUMN `creationDate` `creationDate` DATETIME NULL DEFAULT NOW()
AFTER
	`code`;

ALTER TABLE
	`Authorization` CHANGE COLUMN `corePrefix` `codePrefix` VARCHAR(250) NULL DEFAULT NULL
AFTER
	`codeCore`;

ALTER TABLE
	`Config`
ADD
	COLUMN `event` INT UNSIGNED NOT NULL DEFAULT 0
AFTER
	`macAddress`;