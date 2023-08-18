<?php

class Settings
{
    public function getSettings()
    {
        $settings = $this->loadSettingsFromFile();
        return $settings;
    }

    private function loadSettingsFromFile()
    {
        $file = app  . '/settings/defaults/settings.json';
        $settingsData = file_get_contents($file);
        $settings = json_decode($settingsData, true);
        return $settings ?? null;
    }
}
