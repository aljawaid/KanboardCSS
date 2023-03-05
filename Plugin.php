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
        return t('This pure CSS theme replaces the look and feel of the Kanboard user interface. For modern browsers using gradients and shades of blue and red, KanboardCSS refreshes the the user experience. A new animated notification icon easily identifies new messages without affecting browser performance. All tables and forms are restyled to save screen space and improve productivity. This theme works perfectly with other plugins.');
    }

    public function getPluginAuthor()
    {
        return 'aljawaid';
    }

    public function getPluginVersion()
    {
        return '3.0.0';
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
