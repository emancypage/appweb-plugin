<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Api\Controller\Admin;

use AppWeb\Application\Core\Config;

class WidgetsController
{
    public function render()
    {
        return require_once (Config::getPluginPath() . "/views/admin/widgets.php");
    }
}