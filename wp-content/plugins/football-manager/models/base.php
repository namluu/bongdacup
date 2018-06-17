<?php
class BaseModel
{
    protected $wpdb;

    protected $tableName;

    protected $orderBy = 'name';

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }
    
    public function handleAction($action, $id)
    {
        $result = 0;
        if ($_GET['action'] == 'delete' && $id = $_GET['id']) {
            $result = $this->wpdb->delete($this->tableName, array('id' => $id));
        }
        if ($_GET['action'] == 'inactive' && $id = $_GET['id']) {
            $result = $this->wpdb->update($this->tableName, array('is_active'=>0), array('id' => $id));
        }
        if ($_GET['action'] == 'active' && $id = $_GET['id']) {
            $result = $this->wpdb->update($this->tableName, array('is_active'=>1), array('id' => $id));
        }

        return $result;
    }

    public function getAll()
    {
        return $this->wpdb->get_results( "SELECT * FROM {$this->tableName} ORDER BY {$this->orderBy}", OBJECT );
    }

    public function load($id = null)
    {
        if ($id) {
            $row = $this->wpdb->get_row("SELECT * FROM {$this->tableName} WHERE id = " . $id);
        } else {
            $array = $this->wpdb->get_col( "DESC {$this->tableName}", 0 );
            $row = new stdClass;
            foreach($array as $field){
                $row->$field = '';
            }
        }

        return $row;
    }

    public function save($data, $id = null)
    {
        if ($id) {
            return $this->wpdb->update($this->tableName, $data, array('id' => $id));
        } else {
            $this->wpdb->insert($this->tableName, $data);
            return $this->wpdb->insert_id;
        }
    }

    public function getBy($key, $value)
    {
        return $this->wpdb->get_results( "SELECT * FROM {$this->tableName} WHERE {$key} = {$value} ORDER BY {$this->orderBy}", OBJECT );
    }

    public function searchBy($key, $value)
    {
        return $this->wpdb->get_results( "SELECT * FROM {$this->tableName} WHERE {$key} LIKE '%{$value}%' ORDER BY {$this->orderBy}", OBJECT );
    }

    public function countTotal()
    {
        return $this->wpdb->get_var( "SELECT COUNT(`id`) FROM {$this->tableName}" );
    }
}
