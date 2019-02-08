<?php 
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Pages;

use AppWeb\Application\Core\Config;

/**
* 
*/
class Admin
{
	public function register()
    {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages()
    {
		add_menu_page( 'AppWeb Plugin', 'AppWeb', 'manage_options', 'appweb_plugin', array( $this, 'admin_index' ), 'dashicons-store', 110 );
	}

	public function admin_index()
    {
        $sPluginPath = Config::getPluginPath();
		require_once $sPluginPath . 'views/admin/appweb-main.php';
	}
}