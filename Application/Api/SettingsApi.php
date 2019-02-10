<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Api;

/**
 *
 */
class SettingsApi
{
    protected $adminPages = [];

    protected $adminSubpages = [];

    protected $aCfSettings = [];

    protected $sections = [];

    protected $fields = [];

    public function register()
    {
        if (!empty($this->adminPages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }

        if (!empty($this->aCfSettings)) {
            add_action('admin_init', [$this, 'registerCustomFields']);
        }
    }

    public function addPages(array $pages)
    {
        $this->adminPages = $pages;
        return $this;
    }

    public function withSubPage($title = null)
    {
        if (empty($this->adminPages)) {
            return $this;
        }
        $adminPage = $this->adminPages[0];

        $subpage = [
            [
                'parent_slug' => $adminPage['menu_slug'],
                'page_title' => $adminPage['page_title'],
                'menu_title' => ($title) ? $title : $adminPage['menu_title'],
                'capability' => $adminPage['capability'],
                'menu_slug' => $adminPage['menu_slug'],
                'callback' => $adminPage['callback']
            ]
        ];
        $this->adminSubpages = $subpage;
        return $this;
    }

    public function addSubPages(array $pages)
    {
        $this->adminSubpages = array_merge($this->adminSubpages, $pages);
        return $this;
    }

    public function addAdminMenu()
    {
        foreach ($this->adminPages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }

        foreach ($this->adminSubpages as $subpage) {
            add_submenu_page($subpage['parent_slug'], $subpage['page_title'], $subpage['menu_title'], $subpage['capability'], $subpage['menu_slug'], $subpage['callback']);
        }
    }

    public function setCfSettings(array $settings)
    {
        $this->aCfSettings = $settings;

        return $this;
    }

    public function setCfSections(array $sections)
    {
        $this->sections = $sections;

        return $this;
    }

    public function setCfFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function registerCustomFields()
    {
        // register setting
        foreach ($this->aCfSettings as $setting) {
            register_setting($setting["option_group"], $setting["option_name"], ( isset( $setting["callback"] ) ? $setting["callback"] : ''));
        }

        // add settings section
        foreach ($this->sections as $section) {
            add_settings_section($section["id"], $section["title"], ( isset( $section["callback"] ) ? $section["callback"] : '' ), $section["page"]);
        }

        // add settings field
        foreach ($this->fields as $field) {
            add_settings_field( $field["id"], $field["title"], ( isset( $field["callback"] ) ? $field["callback"] : '' ), $field["page"], $field["section"], ( isset( $field["args"] ) ? $field["args"] : ''));
        }
    }
}