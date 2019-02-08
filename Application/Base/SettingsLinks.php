<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Base;

use AppWeb\Application\Core\Config;

class SettingsLinks
{
	public function register() 
	{
	    $sPluginId = Config::getPluginId();
		add_filter("plugin_action_links_".$sPluginId, array( $this, 'settings_link'));
	}

	public function settings_link($links)
	{
		$settings_link = "<a href=\"admin.php?page=appweb_plugin\">Settings</a>";
		array_push($links, $settings_link);
		return $links;
	}
}