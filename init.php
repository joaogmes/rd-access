<?php

define("root", __DIR__ . '/');
define("app", root . 'app/');

require_once(app . 'autoload.php');
require_once(app .  "controller/ScriptController.php");
require_once(app .  "controller/AccessController.php");
require_once(app .  "controller/RaspberryPiGPIOController.php");


$scriptController = new ScriptController();
$gpioController = new RaspberryPiGPIOController();

while (true) {
    $codeString = trim(readline('# >_  Enter ticket code: '));

    if (is_null($codeString) || $codeString == "") {
        $scriptController->logMessage("Code is null, input a valid code '{$codeString}'");
        continue;
    }

    $scriptController->logMessage("Starting AccessController'...");
    $accessController = new AccessController();

    $scriptController->logMessage("Reading '{$codeString}'...");

    $scriptController->logMessage("Checking pattern...", 2);
    $hasAuth = $accessController->checkAuth($codeString);

    if (!$hasAuth) {
        $scriptController->logMessage("Code not authorized", 3);
        $gpioController->throwError("invalid");
        continue;
    }

    $scriptController->logMessage("Checking local access...", 2);
    $search = $accessController->searchAccessByCode($codeString);
    if ($search) {
        $scriptController->logMessage("Code already passed", 3);
        $gpioController->throwError("repeated");
        continue;
    }

    $scriptController->logMessage("Checking global access...", 2);
    $globalSearch = $accessController->globalSearchAccessByCode($codeString);
    if ($globalSearch) {
        $scriptController->logMessage("Code already passed at {$globalSearch['date']} with id {$globalSearch['id']}", 3);
        $gpioController->throwError("repeated");
        continue;
    }

    $scriptController->logMessage("Inserting code...", 2);
    $access = $accessController->registerAccess($codeString, $hasAuth);

    if (!$access) {
        $scriptController->logMessage("Error while registering access", 3);
        $gpioController->throwError("fail");
        continue;
    }

    $scriptController->logMessage("Turning green light on", 2);
    $gpioController->togglePin(19, "on"); /* green light up */

    $scriptController->logMessage("Opening solenoid", 2);
    $gpioController->togglePin(5, "on"); /* solenoid up */

    $scriptController->logMessage("Waiting for micro", 2);
    $gpioController->waitForGPIOHigh(26); /* wait for micro */

    $scriptController->logMessage("Reseting", 2);
    $gpioController->togglePin(19, "off"); /* turn green of */
    $gpioController->togglePin(13, "on"); /* turn red on */
    continue;
}

/* 
General rulees
read code
check code
if has code = false
if !has code...
insert code
blink green
open vault
wait solenoid
fade green
up red
*/