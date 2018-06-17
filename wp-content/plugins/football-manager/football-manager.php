<?php
if (! defined( 'WPINC' )) die;
/*
Plugin Name: FootballManager
Text Domain: textdomain
Plugin URI: namluu.com
Description: A simple plugin to display footall matches on Frontend. Admin can manage list matches, clubs, leagues on Backend easily.
Version: 1.0
Author: Nam Luu
Author URI: Nam.com
Author Email: nam.luuduc@gmail.com
License:

  Copyright blah blah

*/
if ( ! class_exists( 'FootballManager' ) ) :

class FootballManager
{
    protected $generalController;

    protected $leagueController;

    protected $clubController;

    protected $linkLiveController;

    protected $matchController;

    protected $setupModel;

    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    public function __construct() 
    {
        $this->defineConstants();
        $this->includes();
        $this->initHooks();
    }

    /**
     * Define Constants to use all places in plugin.
     */
    protected function defineConstants()
    {
        // http://bongdacup.com/wp-content/plugins/football-manager
        $this->define('FM_PLUGIN_URL', untrailingslashit( plugins_url( '/', __FILE__ ) ));
        // D:\xampp2\htdocs\demo\bongdacup2\wp-content\plugins\football-manager\football-manager.php
        $this->define('FM_PLUGIN_FILE', __FILE__ );
        // D:\xampp2\htdocs\demo\bongdacup2\wp-content\plugins\football-manager/
        $this->define('FM_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
        // football-manager.php
        $this->define('FM_PLUGIN_NAME', basename( __FILE__ ));
    }

    /**
     * Define constant if not already set.
     *
     * @param  string $name
     * @param  string|bool $value
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    protected function includes()
    {
        include_once( 'controllers/general.php' );
        include_once( 'controllers/league.php' );
        include_once( 'controllers/club.php' );
        include_once( 'controllers/link_live.php' );
        include_once( 'controllers/match.php' );

        include_once( 'models/setup.php' );

        $this->generalController = new General();
        $this->leagueController = new League();
        $this->clubController = new Club();
        $this->linkLiveController = new LinkLive();
        $this->matchController = new Match();

        $this->setupModel = new Setup();
    }

    protected function initHooks()
    {
        register_activation_hook( __FILE__, array( $this->setupModel, 'activate' ) );

        // Register hook executes just before WordPress determines which template page to load
        //add_action( 'template_redirect', array( $this, 'increase_counter_when_home_visited' ) );
        
        // Add extra submenu to the admin panel
        add_action( 'admin_menu', array( $this, 'createMenuAdminPanel' ) );

        // Handle POST request, admin_action_($action)
        add_action( 'admin_post_fm_live_save_action', array( $this->linkLiveController, 'save' ) );
        add_action( 'admin_post_fm_league_save_action', array( $this->leagueController, 'save' ) );
        add_action( 'admin_post_fm_club_save_action', array( $this->clubController, 'save' ) );
        add_action( 'admin_post_fm_match_save_action', array( $this->matchController, 'save' ) );

        // register js
        add_action( 'wp_enqueue_scripts', array( $this, 'registerPluginStyles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'registerPluginScript' ) );

        // rewrite and handle the request 
        add_filter('query_vars', array($this, 'add_query_vars'));
        add_action('init', array($this, 'add_alexes_rules'));
    }

    // add custom child page
    public function add_alexes_rules()
    {
        add_rewrite_rule( '^match/([a-zA-Z\d\-_+]+)?', 'index.php?pagename=match&match_name=$matches[1]', 'top' );
        add_rewrite_rule( '^tran-dau/([a-zA-Z\d\-_+]+)?', 'index.php?pagename=match&match_name=$matches[1]', 'top' );
        add_rewrite_rule( '^truc-tiep/([a-zA-Z\d\-_+]+)?', 'index.php?pagename=xem-truc-tiep-2&match_name=$matches[1]', 'top' );
    }

    public function add_query_vars($aVars) 
    {
        $aVars[] = "match_name"; 
        return $aVars;
    }

    public function add_rewrite_rules($rules)
    {
        $newRules = array('match/([a-zA-Z\d\-_+]+)/?$' => 'index.php?pagename=match&match_name=$matches[1]');
        $rules = $newRules + $rules;
        return $aRules;
    }

    public function registerPluginStyles() 
    {
        // live match js
        if (get_option( 'fm_live_type' ) == 1) {
            wp_register_style( 'fm-live', plugins_url( 'css/live.css', __FILE__ ) );
            wp_enqueue_style( 'fm-live' );
            wp_enqueue_script( 'fm-live-js-livefeed', plugins_url( 'js/livefeed.js', __FILE__ ) );
        } elseif (get_option( 'fm_live_type' ) == 2) {
            wp_enqueue_script( 'fm-live-js-livefeed-2', plugins_url( 'js/livefeed2.js', __FILE__ ) , ['jquery']);
            $hide_linklive = get_option( 'fm_hide_linklive' );
            $dataToBePassed = [
                'hide_linklive' => $hide_linklive
            ];
            wp_localize_script( 'fm-live-js-livefeed-2', 'php_vars', $dataToBePassed );
        }

        wp_enqueue_script( 'fm-live-js-viewer', plugins_url( 'js/viewer.js', __FILE__ ) );
        wp_enqueue_script( 'fm-live-js-init', plugins_url( 'js/frontend-script.js', __FILE__ ) , ['jquery']);
    }

    public function registerPluginScript($hook)
    {
        wp_enqueue_style( 'fm-admin-style', plugins_url( 'css/admin.css', __FILE__ ) );

        if ( 
            'admin_page_football-manager-club-edit' != $hook && 
            'admin_page_football-manager-league-edit' != $hook &&
            'admin_page_football-manager-match-edit' != $hook
            ) {
            return;
        }

        wp_enqueue_script( 'my_custom_script', plugins_url('/js/admin-script.js', __FILE__, ['jquery'], false, true) );
    }

    /**
     * Add main menu Admin's panel : Football Manager
     */ 
    public function createMenuAdminPanel()
    {
        // group all menus in this plugin by this key
        $key = 'football-manager-admin';

        // parent menu
        add_menu_page(
            __( 'Football Manager', 'textdomain' ),
            'Football Manager',
            'manage_options',
            $key,
            array($this->generalController, 'index'),
            FM_PLUGIN_URL . '/images/soccer-ball.png',
            6
        );

        // children menu
        $this->generalController->renderMenu($key);
        $this->leagueController->renderMenu($key);
        $this->clubController->renderMenu($key);
        $this->matchController->renderMenu($key);
        $this->linkLiveController->renderMenu($key);
    }

} // end class

endif;

$plugin_name = new FootballManager();

function getFootballManager($id = null)
{
    global $wpdb;
    $matchTable = $wpdb->prefix . 'fm_match';
    $leagueTable = $wpdb->prefix . 'fm_league';
    $clubTable = $wpdb->prefix . 'fm_club';

    $query = "
        SELECT m.*, 
            l.name league_name, l.link_image league_img, l.url league_url,
            ch.name home_name, ch.url home_url, ch.link_image home_img,
            ca.name away_name, ca.url away_url, ca.link_image away_img
        FROM $matchTable m
            LEFT JOIN $leagueTable l ON m.league_id = l.id
            LEFT JOIN $clubTable ch ON m.home_team_id = ch.id
            LEFT JOIN $clubTable ca ON m.away_team_id = ca.id
        WHERE m.is_active = 1 
    ";

    if ($id) {
        $query .= ' AND m.id = ' . $id;
        $slideshows = $wpdb->get_row($query, OBJECT );
    } else {
        $query .= ' ORDER BY m.match_date';
        $slideshows = $wpdb->get_results($query, OBJECT );
    }

    
    return $slideshows;
}

function getMatch()
{
    global $wp;
    if (isset($wp->query_vars['match_name'])) {
        $matchName = $wp->query_vars['match_name'];
        $parts = explode('-',$matchName);
        $matchId = end($parts);

        if (is_numeric($matchId)) {
            //echo 'get match data with id = '.$matchId;
            $match = getFootballManager($matchId);
            return $match;
        }
    }
    return null;
}

function getLiveMatch()
{
    $c = curl_init('http://mbd.kbongda.net/');
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt(... other options you want...)

    $html = curl_exec($c);

    if (curl_error($c)) {
        return curl_error($c);
    }

    // Get the status code
    $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

    curl_close($c);

    return $html;
}