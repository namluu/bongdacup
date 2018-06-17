<?php
include_once( 'base.php' );

class General extends Base
{
    public function index()
    {
        $this->checkAllow();

        require_once( FM_PLUGIN_DIR_PATH . '/views/general/index.php' );
    }

    public function renderMenu($key)
    {
        add_submenu_page(
            'football-manager-admin',
            __( 'General', 'textdomain' ),
            'General',
            'manage_options',
            $key,
            array($this, 'index')
        );
    }
}