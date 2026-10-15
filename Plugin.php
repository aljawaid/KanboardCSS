<?php

/**
 * Registers the KanboardCSS theme assets and plugin metadata.
 *
 * Related test file: tests/KanboardCssCompatibilityTest.php.
 */

namespace Kanboard\Plugin\KanboardCSS;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        // CSS - Asset Hook
        //  - Keep filename lowercase
        $this->hook->on('template:layout:css', array('template' => 'plugins/KanboardCSS/Assets/css/kanboardcss.css'));
        // Load user overrides last so their declarations win the CSS cascade.
        $this->hook->on('template:layout:css', array('template' => 'plugins/KanboardCSS/Assets/css/kanboardcss-custom.css'));
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }

    public function getPluginName()
    {
        // Plugin Name MUST be identical to namespace for Plugin Directory to detect updated versions
        return 'KanboardCSS';
    }

    public function getPluginDescription()
    {
        return t('This pure CSS theme replaces the look and feel of the Kanboard user interface. For modern browsers using gradients and shades of blue and red, KanboardCSS refreshes the user experience. A new animated notification icon easily identifies new messages. All tables and forms are restyled to save screen space and improve productivity. Install with FontSwitcher to give a complete new overhaul to your application.');
    }

    public function getPluginAuthor()
    {
        return 'aljawaid';
    }

    public function getPluginVersion()
    {
        return '3.7.0';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.54';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/aljawaid/KanboardCSS';
    }
}
