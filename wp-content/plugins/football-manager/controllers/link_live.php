<?php
include_once( 'base.php' );

class LinkLive extends Base
{
    const LINK_INDEX = 'football-link-live';

    public function index()
    {
        $this->checkAllow();

        $type = get_option( 'fm_live_type' );
        $hide_linklive = get_option( 'fm_hide_linklive' );

        require_once( FM_PLUGIN_DIR_PATH . '/views/live/index.php' );
    }

    public function save()
    {
        status_header(200);
        if ( isset( $_POST['save'] ) ) {
            $type = (int)$_POST['type'];
            $hide_linklive = htmlspecialchars($_POST['hide_linklive'], ENT_QUOTES, 'UTF-8');

            update_option( 'fm_live_type', $type );
            update_option( 'fm_hide_linklive', $hide_linklive );
            wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX . '&success=1' ) );
        } else {
            wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX ) );
        }
        exit();
    }

    public function renderMenu($key)
    {
        add_submenu_page(
            $key,
            __( 'Link live', 'textdomain' ),
            'Link live',
            'manage_options',
            self::LINK_INDEX,
            array($this, 'index')
        );
    }
}