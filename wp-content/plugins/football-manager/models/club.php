<?php
include_once( 'base.php' );

class ClubModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = $this->wpdb->prefix . 'fm_club';
        $this->league = $this->wpdb->prefix . 'fm_league';
    }

    public function load($id = null)
    {
        $row = parent::load($id);
        $row->list_league = $this->wpdb->get_results("SELECT * FROM {$this->league}", OBJECT);

        return $row;
    }

    public function getAll($offset = 0, $limit = 0)
    {
        $sql = "
            SELECT c.*, l.name league_name
            FROM {$this->tableName} AS c
            LEFT JOIN {$this->league} AS l ON l.id = c.league_id
            ORDER BY c.name
        ";
        if ($limit) {
            $sql .= " LIMIT $offset, $limit";
        }
        return $this->wpdb->get_results( $sql, OBJECT );
    }
}