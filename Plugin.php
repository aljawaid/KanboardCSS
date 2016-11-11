<?php
namespace Kanboard\Plugin\KanboardCSS;
use Kanboard\Core\Plugin\Base;
class Plugin extends Base
{
    public function initialize()
    {
        $this->hook->on('template:layout:css', array('template' => 'plugins/KanboardCSS/style.css'));
    }
}




