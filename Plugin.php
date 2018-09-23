<?php
namespace Kanboard\Plugin\KanboardCSS;
use Kanboard\Core\Plugin\Base;
class Plugin extends Base
{
    public function initialize()
    {
        $this->hook->on('template:layout:css', array('template' => 'plugins/KanboardCSS/kanboardcss.css'));
    }

    public function getPluginName()
    {
        return 'KanboardCSS';
    }

    public function getPluginDescription()
    {
        return t('A polished CSS theme for modern browsers');
    }

    public function getPluginAuthor()
    {
        return 'Aljawaid';
    }

    public function getPluginVersion()
    {
        return '1.5.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/aljawaid/kanboardcss';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.43';
    }
}
