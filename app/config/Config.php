<?php

class Config
{
    public function getSettings()
    {
        $settings = $this->loadSettingsFromFile();
        return $settings;
    }

    private function loadSettingsFromFile()
    {
        $file = app  . '/config/defaults/settings.json';
        $settingsData = file_get_contents($file);
        $settings = json_decode($settingsData, true);
        return $settings ?? null;
    }
}