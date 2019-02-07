<?php 
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Base;

class Enqueue
{
	public function register() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
	}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style('appweb_pluginstyle', PLUGIN_URL . 'out/css/appweb_pluginstyle.css');
		wp_enqueue_script('appweb_pluginscript', PLUGIN_URL . 'out/js/appweb_pluginscript.js');
	}
}