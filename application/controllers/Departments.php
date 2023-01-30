<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Departments_model');
        define('LOGGED', $this->logged->get_logged()); // highest automatically-assigned error code
    }

    public function get_all() {
        $secretary = $this->uri->segment(3);
        $departments = $this->Departments_model->get_all($secretary);
        echo json_encode($departments);
    }
   
}