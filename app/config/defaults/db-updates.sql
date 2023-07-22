ALTER TABLE `Access`
	CHANGE COLUMN `creationDate` `creationDate` DATETIME NULL DEFAULT NOW() AFTER `code`;
