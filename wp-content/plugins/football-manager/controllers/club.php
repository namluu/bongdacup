<?php
include_once( 'base.php' );

class Club extends Base
{
    const LINK_INDEX = 'football-manager-club';

    const LINK_NEW = 'football-manager-club-new';

    const LINK_EDIT = 'football-manager-club-edit';

    protected $model;

    public function __construct()
    {
        include_once( FM_PLUGIN_DIR_PATH . '/models/club.php' );
        $this->model = new ClubModel();
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

        if (isset($_GET['name']) && $_GET['name']) {
            $clubs = $this->model->searchBy('name', $_GET['name']);
        } elseif (isset($_GET['league']) && $_GET['league']) {
            $clubs = $this->model->getBy('league_id', $_GET['league']);
        } else {
            if (isset($_GET['view-all'])) {
                $clubs = $this->model->getAll();
            } else {
                $limit = 10;
                $total = $this->model->countTotal();
                $page_links = $this->getPagination($total, $limit);
                $clubs = $this->model->getAll($this->offset, $limit);
            }
        }

        $leagues = $this->modelLeague->getAll();

        require_once( FM_PLUGIN_DIR_PATH . '/views/club/index.php' );
    }

    public function add()
    {
        $this->checkAllow();

        $row = $this->model->load();
        $row->is_active = 1;

        $title = 'New Football Club';
        require_once( FM_PLUGIN_DIR_PATH . '/views/club/form.php' );
    }

    public function edit()
    {
        $this->checkAllow();

        if (isset($_GET['id']) && $id = $_GET['id']) {
            $row = $this->model->load($id);
        } else {
            $this->new();
        }

        $title = 'Edit Club: '. $row->name;
        require_once( FM_PLUGIN_DIR_PATH . '/views/club/form.php' );
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
                'league_id' => $_POST['league_id']
                );

            $image = $this->handleUpload();
            if ( $image && !isset( $image['error'] ) ) {
                $data['link_image'] = $image['url'];
            }

            $result = $this->model->save($data, $_POST['id']);

            if ($result) {
                wp_safe_redirect( $this->getAdminUrl( self::LINK_INDEX . '&success=1' ) );
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
        add_filter( 'upload_dir', array($this, 'wpse_141088_upload_dir' ));
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        remove_filter( 'upload_dir', array($this, 'wpse_141088_upload_dir' ));

        return $movefile;
    }

    public function wpse_141088_upload_dir( $dir ) {
        return array(
            'path'   => $dir['basedir'] . '/fm/club',
            'url'    => $dir['baseurl'] . '/fm/club',
            'subdir' => '/fm/club',
        ) + $dir;
    }

    public function renderMenu($key)
    {
        add_submenu_page(
            $key,
            __( 'Club', 'textdomain' ),
            'Club',
            'manage_options',
            self::LINK_INDEX,
            array($this, 'index')
        );

        add_submenu_page(
            null,
            'New Club',
            'New Club',
            'manage_options',
            self::LINK_NEW,
            array($this, 'add')
        );

        add_submenu_page(
            null,
            'Edit Club',
            'Edit Club',
            'manage_options',
            self::LINK_EDIT,
            array($this, 'edit')
        );
    }
}