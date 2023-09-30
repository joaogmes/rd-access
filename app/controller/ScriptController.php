<?php

namespace Controller\Script;

use Controller\Controller;

class ScriptController extends Controller
{
    public function __construct()
    {
    }

    public function logMessage($message, $tabs = 1, $record = false)
    {
        $tabulation = "";
        for ($i = 0; $i < $tabs; $i++) {
            $tabulation .= "    ";
        }
        echo "{$tabulation} # >_  {$message}" . PHP_EOL;
    }
}
