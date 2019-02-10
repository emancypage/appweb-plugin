<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Api\Controller\Admin;

use AppWeb\Application\Core\Config;

class TaxManagerController
{
    public function render()
    {
        return require_once (Config::getPluginPath() . "/views/admin/taxManager.php");
    }
}