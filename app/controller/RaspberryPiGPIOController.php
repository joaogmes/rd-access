<?php

class RaspberryPiGPIOController
{
    private $redLightPin = 24; /* LUZ VERMELHA BCM 19 GPIO 24 P 35 */
    private $greenLightPin = 23; /* LUZ VERDE BCM 13 GPIO 22 P 33 */

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
        $currentState = exec("gpio read {$microPin}");
        $startTime = time();

        while (true) {
            $newState = exec("gpio read {$pinNumber}");

            if ($newState !== $currentState) {
                $endTime = time();
                break;
            }
        }

        return [
            'pinNumber' => $pinNumber,
            'state' => ($currentState === '1') ? 'on' : 'off',
            'duration' => $endTime - $startTime
        ];
    }

    public function throwError($error)
    {
        switch ($error) {
            case "invalid":
                for ($i = 0; $i < 3; $i++) {
                    sleep(0.5);
                    $this->write("red", "off");
                    sleep(0.5);
                    $this->write("red", "on");
                }
                break;
            case "repeated":
                for ($i = 0; $i < 3; $i++) {
                    sleep(0.5);
                    $this->write("red", "off");
                    $this->write("green", "on");
                    sleep(0.5);
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
