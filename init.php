<?php

define("root", __DIR__ . '/');
define("app", root . 'app/');

require_once(app . 'autoload.php');
require_once(app .  "controller/AccessController.php");
require_once(app .  "controller/RaspberryPiGPIOController.php");

function logMessage($message, $tabs = 1)
{
    $tabulation = "";
    for ($i = 0; $i < $tabs; $i++) {
        $tabulation .= "    ";
    }
    echo "{$tabulation} # >_  {$message}" . PHP_EOL;
}

while (true) {
    $codeString = trim(readline('# >_  Enter ticket code: '));

    if (is_null($codeString) || $codeString == "") {
        logMessage("Code is null, input a valid code '{$codeString}'");
        continue;
    }

    logMessage("Starting AccessController'...");
    $accessController = new AccessController();

    $gpioController = new RaspberryPiGPIOController();

    logMessage("Reading '{$codeString}'...");
    $search = $accessController->searchByCode($codeString);

    if ($search) {
        logMessage("Code already passed", 2);
        for ($i=0; $i < 3 ; $i++) { 
            logMessage("Sleep {i}", 3);
            $gpioController->togglePin(17, "on", 1);
        }
        continue;
    }

    logMessage("Code not found on local access, checking for global access...", 2);
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
*/