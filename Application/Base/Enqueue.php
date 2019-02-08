<?php 
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Base;

use AppWeb\Application\Core\Config;

class Enqueue
{
	public function register()
    {
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
	}
	
	function enqueue()
    {
        $sPluginUrl = Config::getPluginUrl();
		// enqueue all our scripts
		wp_enqueue_style('appweb_pluginstyle', $sPluginUrl . 'out/css/appweb_pluginstyle.css');
		wp_enqueue_script('appweb_pluginscript', $sPluginUrl . 'out/js/appweb_pluginscript.js');
	}
}