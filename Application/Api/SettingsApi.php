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

    public function register()
    {
        if (!empty($this->adminPages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);
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
}