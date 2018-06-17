<?php
include_once( 'base.php' );

class Match extends Base
{
    const LINK_INDEX = 'football-manager-match';

    const LINK_NEW = 'football-manager-match-new';

    const LINK_EDIT = 'football-manager-match-edit';

    protected $model;

    public function __construct()
    {
        include_once( FM_PLUGIN_DIR_PATH . '/models/match.php' );
        $this->model = new MatchModel();
        $this->modelLeague = new LeagueModel();
    }

    public function index()
    {
        $this->checkAllow();

        if (isset($_GET['action']) && $_GET['id']) {
            $result = $this->model->handleAction($_GET['action'], $_GET['id']);
            
            if ($result) {
                add_settings_error('index', 'index', 'Update successfully', 'updated');
            }
        }

        if (isset($_GET['league']) && $_GET['league']) {
            $matches = $this->model->getBy('league_id', $_GET['league']);
        } else {
            $matches = $this->model->getAll();
        }
        
        $leagues = $this->modelLeague->getAll();

        require_once( FM_PLUGIN_DIR_PATH . '/views/match/index.php' );
    }

    public function add()
    {
        $this->checkAllow();

        $row = $this->model->load();
        $row->is_active = 1;

        $title = 'New Football Match';
        $this->includeAssets();
        require_once( FM_PLUGIN_DIR_PATH . '/views/match/form.php' );
    }

    public function edit()
    {
        $this->checkAllow();

        if (isset($_GET['id']) && $id = $_GET['id']) {
            $row = $this->model->load($id);
        } else {
            $this->new();
        }

        $title = 'Edit Match: '. $row->name;
        $this->includeAssets();
        require_once( FM_PLUGIN_DIR_PATH . '/views/match/form.php' );
    }

    public function save()
    {
        $this->checkAllow();

        status_header(200);
        if ( isset( $_POST['save'] ) ) {
            $date = new DateTime($_POST['match_date']);
            $data = array(
                'name' => $_POST['name'],
                'url' => $_POST['url'] ? $_POST['url'] : sanitize_title($_POST['name']),
                'description' => stripslashes_deep($_POST['description']),
                'home_team_id' => $_POST['home_team_id'],
                'away_team_id' => $_POST['away_team_id'],
                'match_date' => date('Y-m-d H:i:s', $date->getTimestamp()),
                'league_id' => $_POST['league_id'],
                'is_active' => $_POST['is_active']
                );

            $result = $this->model->save($data, $_POST['id']);

            if ($result) {
                wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX . '&success=1' ) );
            } else {
                wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX . '&error=1' ) );
            }
        }
        wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX ) );
    }

    public function renderMenu($key)
    {
        add_submenu_page(
            $key,
            __( 'Match', 'textdomain' ),
            'Match',
            'manage_options',
            self::LINK_INDEX,
            array($this, 'index')
        );

        add_submenu_page(
            null,
            'New Match',
            'New Match',
            'manage_options',
            self::LINK_NEW,
            array($this, 'add')
        );

        add_submenu_page(
            null,
            'Edit Match',
            'Edit Match',
            'manage_options',
            self::LINK_EDIT,
            array($this, 'edit')
        );
    }

    protected function includeAssets()
    {
        wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        wp_enqueue_style('fm-selectpicker', FM_PLUGIN_URL . '/css/bootstrap-select.min.css' );
        wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', ['jquery'], false, true);
        wp_enqueue_script('fm-selectpickerjs', FM_PLUGIN_URL . '/js/bootstrap-select.min.js', ['bootstrap'], false, true);

        wp_enqueue_style('fm-datetimepicker', FM_PLUGIN_URL . '/css/bootstrap-datetimepicker.css' );
        wp_enqueue_script('momment', 'http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js');
        wp_enqueue_script('datetimepicker', FM_PLUGIN_URL . '/js/bootstrap-datetimepicker.js', ['bootstrap'], false, true);
    }
}