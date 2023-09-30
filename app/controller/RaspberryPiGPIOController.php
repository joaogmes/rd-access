<?php

namespace Controller\Rasp;

class RaspberryPiGPIOController
{
    private $redLightPin = 23; /* LUZ VERMELHA BCM 19 GPIO 24 P 35 */
    private $greenLightPin = 24; /* LUZ VERDE BCM 13 GPIO 22 P 33 */

    private $solenoidPin = 21; /* SOLENOIDE BCM 5 GPIO 21 P 29 */
    private $microPin = 25; /* MICRO BCM 26 GPIO 25 P 37 */


    public function __construct()
    {
        $this->configurePins();
        $this->startStatus();
    }

    private function configurePins()
    {
        exec("gpio mode {$this->redLightPin} out");
        exec("gpio mode {$this->greenLightPin} out");
        exec("gpio mode {$this->solenoidPin} out");
        exec("gpio mode {$this->microPin} in");
    }

    private function write($target, $mode)
    {
        switch ($target) {
            case 'green';
                if ($mode == "on") {
                    exec("gpio write {$this->greenLightPin} 0");
                } else {
                    exec("gpio write {$this->greenLightPin} 1");
                }
                break;
            case 'red';
                if ($mode == "on") {
                    exec("gpio write {$this->redLightPin} 0");
                } else {
                    exec("gpio write {$this->redLightPin} 1");
                }
                break;
            case 'solenoid';
                if ($mode == "on") {
                    exec("gpio write {$this->solenoidPin} 1");
                } else {
                    exec("gpio write {$this->solenoidPin} 0");
                }
                break;
        }
    }

    private function startStatus()
    {
        $this->write("red", "on");
        $this->write("green", "off");
        $this->write("solenoid", "off");
    }

    public function waitMicro()
    {
        $currentState = exec("gpio read {$this->microPin}");
        $startTime = time();

        while (true) {
            $newState = exec("gpio read {$this->microPin}");

            if ($newState !== $currentState) {
                $endTime = time();
                break;
            }
        }

        $timeDiff = $endTime - $startTime;
        echo "Time difference = ${timeDiff}";
    }

    public function throwError($error)
    {
        switch ($error) {
            case "invalid":
                for ($i = 0; $i < 3; $i++) {
                    usleep(300000);
                    $this->write("red", "off");
                    usleep(300000);
                    $this->write("red", "on");
                }
                break;
            case "repeated":
                for ($i = 0; $i < 3; $i++) {
                    usleep(300000);
                    $this->write("red", "off");
                    $this->write("green", "on");
                    usleep(300000);
                    $this->write("red", "on");
                    $this->write("green", "off");
                }
                break;
        }
        return true;
    }

    public function throwSuccess()
    {
        $this->write("red", "off");
        $this->write("green", "on");
        $this->write("solenoid", "on");

        $this->waitMicro();

        $this->startStatus();
    }
}
