<?php
include_once( 'base.php' );

class League extends Base
{
    const LINK_INDEX = 'football-manager-league';

    const LINK_NEW = 'football-manager-league-new';

    const LINK_EDIT = 'football-manager-league-edit';

    protected $model;

    public function __construct()
    {
        include_once( FM_PLUGIN_DIR_PATH . '/models/league.php' );
        $this->model = new LeagueModel();
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

        $leagues = $this->model->getAll();

        require_once( FM_PLUGIN_DIR_PATH . '/views/league/index.php' );
    }

    public function add()
    {
        $this->checkAllow();

        $row = $this->model->load();
        $row->is_active = 1;

        $title = 'New Football Leagues';
        require_once( FM_PLUGIN_DIR_PATH . '/views/league/form.php' );
    }

    public function edit()
    {
        $this->checkAllow();

        if (isset($_GET['id']) && $id = $_GET['id']) {
            $row = $this->model->load($id);
        } else {
            $this->new();
        }

        $title = 'Edit League: '. $row->name;
        require_once( FM_PLUGIN_DIR_PATH . '/views/league/form.php' );
    }

    public function save()
    {
        $this->checkAllow();

        status_header(200);
        if ( isset( $_POST['save'] ) ) {

            $data = array(
                'name' => $_POST['name'],
                'url' => $_POST['url'] ? $_POST['url'] : sanitize_title($_POST['name']),
                'description' => stripslashes_deep($_POST['description']),
                'is_active' => $_POST['is_active'],
                'is_world' => $_POST['is_world']
                );

            $image = $this->handleUpload();
            if ( $image && !isset( $image['error'] ) ) {
                $data['link_image'] = $image['url'];
            }

            $result = $this->model->save($data, $_POST['id']);

            if ($result) {
                wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX . '&success=1') );
            } else {
                wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX . '&error=1' ) );
            }
        }
        wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX ) );
    }

    public function handleUpload()
    {
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }
        $uploadedfile = $_FILES['link_image'];
        $upload_overrides = array( 'test_form' => false );

        // Register our path override.
        add_filter( 'upload_dir', array($this, 'wpse_141088_upload_dir' ));

        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

        // Set everything back to normal.
        remove_filter( 'upload_dir', array($this, 'wpse_141088_upload_dir' ));

        return $movefile;
    }

    /**
     * Override the default upload path.
     * 
     * @param   array   $dir
     * @return  array
     */
    public function wpse_141088_upload_dir( $dir ) {
        return array(
            'path'   => $dir['basedir'] . '/fm/league',
            'url'    => $dir['baseurl'] . '/fm/league',
            'subdir' => '/fm/league',
        ) + $dir;
    }

    public function renderMenu($key)
    {
        add_submenu_page(
            $key, # add index link to parent menu
            __( 'League', 'textdomain' ),
            'League',
            'manage_options',
            self::LINK_INDEX,
            array($this, 'index')
        );

        add_submenu_page(
            null,
            'New League',
            'New League',
            'manage_options',
            self::LINK_NEW,
            array($this, 'add')
        );

        add_submenu_page(
            null,
            'Edit League',
            'Edit League',
            'manage_options',
            self::LINK_EDIT,
            array($this, 'edit')
        );
    }
}