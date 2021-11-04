<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function select($table, $where)
    {
        $this->db->select('*')
            ->from($table)
            ->where($where);
        return $this->db->get();
    }

    public function update($table, $data, $where)
    {
        return $this->db->where($where)->update($table,$data);
    }

    public function query($query)
    {
        return $this->db->query($query);
    }

}

