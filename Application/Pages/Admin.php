<?php 
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Pages;

use AppWeb\Application\Api\Controller\Admin\CPTController;
use AppWeb\Application\Api\Controller\Admin\DashboardController;
use AppWeb\Application\Api\Controller\Admin\TaxManagerController;
use AppWeb\Application\Api\Controller\Admin\WidgetsController;
use AppWeb\Application\Api\SettingsApi;

/**
* 
*/
class Admin
{
    /** @var SettingsApi  */
    protected $settings;

    /** @var array Array of pages declaration */
    protected $pages = [];
    protected $subpages = [];

    public function __construct()
    {
        $this->settings = new SettingsApi();
        $this->addPages();
        $this->addSubpages();
    }

    public function register()
    {
        $this->settings->addPages($this->pages)
            ->withSubPage('Dashboard')
            ->addSubPages($this->subpages)
            ->register();
	}

	protected function addPages()
    {
        $this->pages = [
            [
                'page_title' => 'AppWeb Plugin',
                'menu_title' => 'AppWeb',
                'capability' => 'manage_options',
                'menu_slug' => 'appweb_plugin',
                'icon_url' => 'dashicons-store',
                'position' => 110,
                'callback' => [new DashboardController(), 'render']
            ]
        ];
    }

    protected function addSubpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'appweb_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'appweb_plugin_cpt',
                'callback' => [new CPTController(), 'render']
            ],
            [
                'parent_slug' => 'appweb_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'appweb_plugin_taxonomies',
                'callback' => [new TaxManagerController(), 'render']
            ],
            [
                'parent_slug' => 'appweb_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug' => 'appweb_plugin_widgets',
                'callback' => [new WidgetsController(), 'render']
            ]
        ];
    }
}