<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('Ldap_model');
        define('LOGGED', $this->logged->get_logged()); // highest automatically-assigned error code
        // $this->logged->verifica_permissoes($permission);
    }

    // public function new_ldap()
    // {
    //     $this->template->load('template', 'settings/new_ldap_view');
    //     $this->save_ldap();
    // }

    public function update_ldap(){
        $id_page = 6;
        $this->logged->verifica_permissoes($id_page);
        
        $data['ldap'] = $this->Ldap_model->get_ldap();
        $this->template->load('template', 'settings/update_ldap_view', $data);
    }

    public function remake_ldap(){
        if($this->uri->segment(3)){
            $id = $this->uri->segment(3);
        }else{
            $id = $this->input->post('id');
        }
        $data['ldap'] = $this->Ldap_model->get_info_ldap($id);

        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('domain', 'Domínio', 'required');
        $this->form_validation->set_rules('server', 'Servidor', 'required');
        $this->form_validation->set_rules('port', 'Porta', 'required|numeric');

        if ($this->form_validation->run() == FALSE) { 
            $data['erros'] = array('message' => validation_errors());
            $this->template->load('template', 'settings/remake_ldap_view', $data);
        }else{
            $this->load->model('Ldap_model');
            $update = $this->Ldap_model->upd_ldap($this->input->post());// aqui
            if($update['type']){
                $data['success']['message'] = $update['message'];
                $data['ldap'] = $this->Ldap_model->get_ldap();
                $this->template->load('template', 'settings/update_ldap_view', $data);
            }else{
                $data['erros']['message'] = $update['message'];
                $this->template->load('template', 'settings/remake_ldap_view', $data);
            }

        } 
    }

    public function new_ldap(){
        $id_page = 6;
        $this->logged->verifica_permissoes($id_page);

        $data['inputs'] = $this->input->post();

        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('domain', 'Dominio', 'required');
        $this->form_validation->set_rules('server', 'Servidor', 'required');
        $this->form_validation->set_rules('port', 'Porta', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['erros'] = array('message' => validation_errors());
            $this->template->load('template', 'settings/new_ldap_view', $data);
        }else{
            $this->load->model('Ldap_model');
            $insert = $this->Ldap_model->new_ldap($this->input->post());
            if($insert['type']){
                $data['success']['message'] = $insert['message'];
                $this->template->load('template', 'settings/new_ldap_view', $data);
            }else{
                $data['erros']['message'] = $insert['message'];
                $this->template->load('template', 'settings/new_ldap_view', $data);
            }
            
        }
    }
    
}
