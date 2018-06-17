<?php
include_once( 'base.php' );

class LeagueModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = $this->wpdb->prefix . 'fm_league';
    }
}