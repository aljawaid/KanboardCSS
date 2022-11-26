<?php

namespace Kanboard\Plugin\KanboardCSS;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        // CSS - Asset Hook
        //  - Keep filename lowercase
        $this->hook->on('template:layout:css', array('template' => 'plugins/KanboardCSS/Assets/css/kanboardcss-custom.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/KanboardCSS/Assets/css/kanboardcss.css'));
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        // Plugin Name MUST be identical to namespace for Plugin Directory to detect updated versions
        return 'KanboardCSS';
    }

    public function getPluginDescription()
    {
        return t('This plugin adds a new style for the Kanboard user interface. As a polished theme for modern browsers using gradients and shades of blue and red, this theme refreshes the Kanboard interface to complement the user experience.');
    }

    public function getPluginAuthor()
    {
        return 'aljawaid';
    }

    public function getPluginVersion()
    {
        return '1.5.0';
    }

    public function getCompatibleVersion()
    {
        // Examples:
        // >=1.0.37
        // <1.0.37
        // <=1.0.37
        return '>1.0.43';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/aljawaid/KanboardCSS';
    }
}
