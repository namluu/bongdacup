<?php
class Setup
{
    protected $version = '1.0';

    public function activate()
    {
        if ( version_compare( get_bloginfo( 'version' ), '2.6', '<' ) ) {
            deactivate_plugins( FM_PLUGIN_NAME );
        } else {
            global $wpdb;
            //$charset_collate = $wpdb->get_charset_collate();
            $charset_collate = 'CHARACTER SET utf8 COLLATE utf8_bin';
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); // to run dbDelta()

            $table_name = $wpdb->prefix . 'fm_league';
            $sql = "CREATE TABLE $table_name (
                id int(9) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                url varchar(255) NOT NULL,
                description text NULL,
                link_image varchar(255) NOT NULL,
                is_active tinyint(1) NOT NULL default 1,
                ordering int(9) NOT NULL default 0,
                created_date timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
                UNIQUE KEY id (id)
            ) $charset_collate;";
            dbDelta($sql);

            $table_name = $wpdb->prefix . 'fm_club';
            $sql = "CREATE TABLE $table_name (
                id int(9) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                url varchar(255) NOT NULL,
                description text NULL,
                link_image varchar(255) NOT NULL,
                is_active tinyint(1) NOT NULL default 1,
                ordering int(9) NOT NULL default 0,
                created_date timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
                UNIQUE KEY id (id)
            ) $charset_collate;";
            dbDelta($sql);

            $table_name = $wpdb->prefix . 'fm_match';
            $sql = "CREATE TABLE $table_name (
                id int(9) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                url varchar(255) NOT NULL,
                description text NULL,
                home_team_id int(9) NOT NULL,
                away_team_id int(9) NOT NULL,
                match_date timestamp,
                league_id int(9) NOT NULL,
                is_active tinyint(1) NOT NULL default 1,
                is_hot tinyint(1) NOT NULL default 1,
                ordering int(9) NOT NULL default 0,
                created_date timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
                UNIQUE KEY id (id)
            ) $charset_collate;";
            dbDelta($sql);

            add_option( 'fm_version', $this->version );

            $this->setupSampleData();
        }
    }

    public function setupSampleData()
    {
        global $wpdb;
        // league
        $tableName = $wpdb->prefix . 'fm_league';
        $leagueImg = WP_CONTENT_URL.'/uploads/fm/league/';
        $wpdb->insert($tableName, array(
            'name' => 'Ngoại Hạng Anh',
            'url' => sanitize_title('Ngoại Hạng Anh'),
            'description' => '',
            'link_image' => $leagueImg.'eng.jpg'
        ));
        $wpdb->insert($tableName, array(
            'name' => 'Hạng Nhất Pháp',
            'url' => sanitize_title('Hạng Nhất Pháp'),
            'description' => '',
            'link_image' => $leagueImg.'fra.jpg'
        ));
        $wpdb->insert($tableName, array(
            'name' => 'La liga',
            'url' => sanitize_title('La liga'),
            'description' => '',
            'link_image' => $leagueImg.'laliga.jpg'
        ));

        // club
        $tableName = $wpdb->prefix . 'fm_club';
        $clubImg = WP_CONTENT_URL.'/uploads/fm/club/';
        $wpdb->insert($tableName, array(
            'name' => 'Liverpool',
            'url' => sanitize_title('Liverpool'),
            'description' => '',
            'link_image' => $clubImg.'liv.jpg'
        ));
        $wpdb->insert($tableName, array(
            'name' => sanitize_title('Manchester City'),
            'url' => '',
            'description' => '',
            'link_image' => $clubImg.'manc.jpg'
        ));
    }
}
?>