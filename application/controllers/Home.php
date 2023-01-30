<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Contact_model');
        define('LOGGED', $this->logged->get_logged()); // highest automatically-assigned error code
    }

    public function index() {
        if(!LOGGED){
            $this->Logs_model->insert_log_access();
        }
        $data['contacts'] = $this->Contact_model->get_contacts_home();
        $this->template->load('template', 'home/home_view', $data);
    }

    public function acesso_negado() {
        $this->template->load('template', 'home/acesso_negado_view');
    }

}
