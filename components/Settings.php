<?php

namespace app\components;

use yii\helpers\Url;
use app\helpers\Helper;

class Settings {
    private $settings;
    private $settingsFile;
    
    public function __construct($settingsFile = null) {
        $this->settingsFile = $settingsFile ? $settingsFile : Url::to('@app/config/settings.xml');
        $this->loadSettings();
    }
    
    private function loadSettings() {
        // custom initialization code goes here
        
        if (file_exists($this->settingsFile)) {
            $settingsXml = simplexml_load_file($this->settingsFile);
            if (!$settingsXml) {
                \Yii::error('Could not load settings file on console command', 'Niloos Get Service');
                return false;
            }
            $this->settings = Helper::xml2array($settingsXml);
        } else {
            \Yii::error('Settings file not exist console command', 'Niloos Get Service');
        }
    }
    
    public function getSettings() {
        return $this->settings;
    }
} 