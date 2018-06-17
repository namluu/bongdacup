<?php
	//if uninstall not called from WordPress exit
	if (!defined('WP_UNINSTALL_PLUGIN'))
		exit();
	
    // delete table
    global $wpdb;
    $table_name = $wpdb->prefix . 'fm_league';
    $sql = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query($sql);

    $table_name = $wpdb->prefix . 'fm_club';
    $sql = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query($sql);

	// delete option from options table
	delete_option('fm_version');
?>