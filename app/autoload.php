<?php

/* Config */
require_once(app . '/settings/Settings.php');

/* Core */
require_once(app . '/core/Dao.php');
require_once(app . '/core/Controller.php');

/* Dao */
require_once(app .  "dao/AccessDao.php");
require_once(app .  "dao/AuthorizationDao.php");
require_once(app .  "dao/ConfigDao.php");
require_once(app .  "dao/LogDao.php");

/* Model */
require_once(app .  "model/AccessModel.php");
require_once(app .  "model/AuthorizationModel.php");
require_once(app .  "model/ConfigModel.php");
require_once(app .  "model/LoginModel.php");
require_once(app .  "model/LogModel.php");

/* Controller */
require_once(app .  "controller/AccessController.php");
require_once(app .  "controller/AuthorizationController.php");
require_once(app .  "controller/ConfigController.php");
require_once(app .  "controller/LogController.php");
require_once(app .  "controller/LoginController.php");
require_once(app .  "controller/RaspberryPiGPIOController.php");
require_once(app .  "controller/ScriptController.php");