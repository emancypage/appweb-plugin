<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Core;

class Config
{
    public static function getPluginPath()
    {
        return plugin_dir_path(dirname(__FILE__, 2));
    }

    public static function getPluginUrl()
    {
        return plugin_dir_url(dirname(__FILE__, 2));
    }

    public static function getPluginId()
    {
        return plugin_basename(dirname(__FILE__, 3)).'/appweb-plugin.php';
    }
}