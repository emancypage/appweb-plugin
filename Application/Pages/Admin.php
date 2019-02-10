<?php 
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Pages;

use AppWeb\Application\Api\Controller\Admin\CPTController;
use AppWeb\Application\Api\Controller\Admin\CustomFieldsCallbacks;
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
    protected $oSettingsApi;

    /** @var array Array of pages declaration */
    protected $pages = [];

    /** @var array Array of subpages declaration */
    protected $subpages = [];

    public function __construct()
    {
        $this->oSettingsApi = new SettingsApi();
        $this->setPages();
        $this->setSubpages();
    }

    public function register()
    {
        $this->setCfSettings();
        $this->setCfSections();
        $this->setCfFields();

        $this->oSettingsApi->addPages($this->pages)
            ->withSubPage('Dashboard')
            ->addSubPages($this->subpages)
            ->register();
	}

	protected function setPages()
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

    protected function setSubpages()
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

    public function setCfSettings()
    {
        $args = array(
            array(
                'option_group' => 'appweb_options_group',
                'option_name' => 'text_example',
                'callback' => array( new CustomFieldsCallbacks(), 'appwebInputCallback' )
            ),
            array(
                'option_group' => 'appweb_options_group',
                'option_name' => 'first_name'
            )
        );

        $this->oSettingsApi->setCfSettings( $args );
    }

    public function setCfSections()
    {
        $args = array(
            array(
                'id' => 'appweb_admin_index',
                'title' => 'Settings',
                'callback' => array( new CustomFieldsCallbacks(), 'appwebAdminSection' ),
                'page' => 'appweb_plugin'
            )
        );

        $this->oSettingsApi->setCfSections( $args );
    }

    public function setCfFields()
    {
        $args = array(
            array(
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => array( new CustomFieldsCallbacks(), 'appwebTextExample' ),
                'page' => 'appweb_plugin',
                'section' => 'appweb_admin_index',
                'args' => array(
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                )
            ),
            array(
                'id' => 'first_name',
                'title' => 'First Name',
                'callback' => array( new CustomFieldsCallbacks(), 'appwebFirstName' ),
                'page' => 'appweb_plugin',
                'section' => 'appweb_admin_index',
                'args' => array(
                    'label_for' => 'first_name',
                    'class' => 'example-class'
                )
            )
        );

        $this->oSettingsApi->setCfFields( $args );
    }
}