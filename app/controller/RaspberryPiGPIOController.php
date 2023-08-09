<?php

class RaspberryPiGPIOController
{
    private $redLightPin = 13; /* 33 phisicaly, 19 on GPIO mapping */
    private $greenLightPin = 19; /* 35 phisicaly, 19 on GPIO mapping */

    private $solenoidPin = 5; /* 29 phisicaly, 5 on GPIO mapping */
    private $microPin = 26; /* 37 phisicaly, 26 on GPIO mapping */
    

    public function __construct()
    {
        // exec('gpio mode all out');
    }

    public function togglePin($pinNumber, $mode, $time = 0)
    {
        if ($mode !== 'on' && $mode !== 'off') {
            echo "Invalid mode. Use 'on' or 'off' to control the pin.\n";
            return;
        }

        $command = "gpio write {$pinNumber} " . ($mode === 'on' ? '1' : '0');
        exec($command);

        if ($time > 0) {
            sleep($time);
            $this->togglePin($pinNumber, $mode, 0);
        }
    }

    public function readInputPin($pinNumber)
    {
        $currentState = exec("gpio read {$pinNumber}");
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
    function waitForGPIOHigh($gpioPin)
    {
        if (!is_numeric($gpioPin) || $gpioPin < 0 || $gpioPin > 27) {
            echo "Invalid GPIO pin number. Please provide a valid BCM GPIO number (0-27).\n";
            return;
        }

        while (true) {
            $currentState = exec("gpio read {$gpioPin}");

            if ($currentState === '1') {
                echo "GPIO {$gpioPin} is HIGH (1). Triggering the event or action...\n";
                break;
            }

            sleep(0.1);
        }
    }
    function throwError($error)
    {
        return true;
        switch ($error) {
            case "invalid": 
                /* Code format is no accepted */
                /* Blink red lights 2 times */
                $this->togglePin($this->redLightPin, "on", 0.2);
                sleep(0.5);
                $this->togglePin($this->redLightPin, "on", 0.2);
                break;
            case "repeated": 
                /* Code format is no accepted */
                /* Blink red lights 4 times */
                $this->togglePin($this->redLightPin, "on", 0.2);
                sleep(0.5);
                $this->togglePin($this->redLightPin, "on", 0.2);
                sleep(0.5);
                $this->togglePin($this->redLightPin, "on", 0.2);
                sleep(0.5);
                $this->togglePin($this->redLightPin, "on", 0.2);
                break;
        }
        return true;
    }
}

// // Usage example:
// $gpioController = new RaspberryPiGPIOController();

// // Toggle output pin 17 on for 2 seconds
// $gpioController->togglePin(17, 'on', 2);

// // Usage example: Wait for GPIO 5 (BCM GPIO number) to become 1
// $gpioController->waitForGPIOHigh(5);

// // Read the state and duration of input pin 18
// $result = $gpioController->readInputPin(18);
// echo "Pin {$result['pinNumber']} is {$result['state']} for {$result['duration']} seconds.\n";