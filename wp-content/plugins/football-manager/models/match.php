<?php
include_once( 'base.php' );

class MatchModel extends BaseModel
{
    protected $orderBy = 'match_date';

    public function __construct()
    {
        parent::__construct();
        $this->tableName = $this->wpdb->prefix . 'fm_match';
        $this->club = $this->wpdb->prefix . 'fm_club';
        $this->league = $this->wpdb->prefix . 'fm_league';
    }

    public function load($id = null)
    {
        $row = parent::load($id);
        $row->list_team = $this->wpdb->get_results("SELECT * FROM {$this->club}", OBJECT);
        $row->list_league = $this->wpdb->get_results("SELECT * FROM {$this->league}", OBJECT);

        return $row;
    }

    public function save($data, $id = null)
    {
        $dataId = parent::save($data, $id);
        // is create
        if (!$id) {
            $match = $this->load($dataId);
            $data['url'] = $match->url . '-' . $dataId;
            return parent::save($data, $dataId);
        }
        return $dataId;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->tableName}";

        if (isset($_GET['orderby']) && isset($_GET['order'])) {
            $sql .= ' ORDER BY ' . $_GET['orderby'] . ' ' . $_GET['order'];
        } else {
            $sql .= ' ORDER BY ' . $this->orderBy;
        }
        return $this->wpdb->get_results( $sql, OBJECT );
    }
}