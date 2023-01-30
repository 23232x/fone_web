<?php

error_reporting(1);

class Departments_model extends CI_Model {

    function __construct() { 
        parent::__construct();
        $this->load->model('Logs_model');
    }

    public function get_all($secretary){
        $this->db->where('id_secretary', $secretary);
        $this->db->where('status', 1);
        $this->db->order_by('name');
        $query = $this->db->get('departments');
        return $query->result();
    }

}
?>