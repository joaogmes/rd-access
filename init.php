<?php

define("root", __DIR__ . '/');
define("app", root . 'app/');

require_once(app . 'autoload.php');
require_once(app .  "controller/AccessController.php");
require_once(app .  "controller/RaspberryPiGPIOController.php");

function logMessage($message, $tabs = 1, $record = false)
{
    $tabulation = "";
    for ($i = 0; $i < $tabs; $i++) {
        $tabulation .= "    ";
    }
    echo "{$tabulation} # >_  {$message}" . PHP_EOL;
}

$gpioController = new RaspberryPiGPIOController();

while (true) {
    $codeString = trim(readline('# >_  Enter ticket code: '));

    if (is_null($codeString) || $codeString == "") {
        logMessage("Code is null, input a valid code '{$codeString}'");
        continue;
    }

    logMessage("Starting AccessController'...");
    $accessController = new AccessController();

    logMessage("Reading '{$codeString}'...");

    logMessage("Checking pattern...", 2);
    $hasAuth = $accessController->checkAuth($codeString);
    if (!$hasAuth) {
        logMessage("Code not authorized", 3);
        $gpioController->throwError("invalid");
        continue;
    }

    logMessage("Checking local access...", 2);
    $search = $accessController->searchByCode($codeString);
    if ($search) {
        logMessage("Code already passed", 3);
        $gpioController->throwError("repeated");
        continue;
    }

    logMessage("Checking global access...", 2);
    $globalSearch = $accessController->globalSearchByCode($codeString);
    if ($search) {
        logMessage("Code already passed at {$search['date']} with id {$search['id']}", 3);
        $gpioController->throwError("repeated");
        continue;
    }

    logMessage("Inserting code...", 2);
    $access = $accessController->registerAccess($codeString, $hasAuth);
    if (!$access) {
        logMessage("Error while registering access", 3);
        $gpioController->throwError("fail");
        continue;
    }

    logMessage("Turning green light on", 2);
    $gpioController->togglePin(19, "on"); /* green light up */

    logMessage("Opening solenoid", 2);
    $gpioController->togglePin(5, "on"); /* solenoid up */

    logMessage("Waiting for micro", 2);
    $gpioController->waitForGPIOHigh(26); /* wait for micro */

    logMessage("Reseting", 2);
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