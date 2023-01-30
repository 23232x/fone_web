<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('pagination');
        define('LOGGED', $this->logged->get_logged());
        // $this->logged->verifica_permissoes($permission);
    }

    public function new_user() {
        $id_page = 4;
        $this->logged->verifica_permissoes($id_page);

        $data['ldap'] = $this->Users_model->get_ldap();
        $data['permission'] = $this->Users_model->get_permission($id);    

        $data['inputs'] = $this->input->post();

        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('user_ldap', 'Usuário LDAP', 'required');
        $this->form_validation->set_rules('id_ldap', 'LDAP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['erros'] = array('message' => validation_errors());
            $this->template->load('template', 'users/new_user_view', $data);
        }else{
            $this->load->model('Users_model');
            $retorno = $this->Users_model->new_user($data['inputs']);
            if($retorno['type']){
                $data['success']['message'] = $retorno['message'];
                $this->template->load('template', 'users/new_user_view', $data);             
            }else{
                $data['erros']['message'] = $retorno['message'];
                $this->template->load('template', 'users/new_user_view', $data);
            }
        }  
    }

   public function update_user() {
        $data['ldap'] = $this->Users_model->get_ldap();
        $data['permission'] = $this->Users_model->get_permission($id);        

        if($this->uri->segment(3)){
            $id = $this->uri->segment(3);
        }else{
            $id = $this->input->post('id');
        }
        $data['users'] = $this->Users_model->get_info_user($id);
        $data['users_p'] = $this->Users_model->get_permissions_by_user($id);
        // echo "<pre>";
        // print_r($data);die;
        // echo "</pre>";      

        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('user_ldap', 'Usuário LDAP', 'required');
        $this->form_validation->set_rules('id_ldap', 'LDAP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['erros'] = array('message' => validation_errors());
            $this->template->load('template', 'users/update_user_view', $data);
        }else{
            $this->load->model('Users_model');
            $retorno = $this->Users_model->update_user($this->input->post());
            // echo "<pre>";
            // print_r($this->input->post());die;
            // echo "</pre>";die;
            if($retorno['type']){
                $data['success']['message'] = $retorno['message'];
                $this->get_user(NULL, $retorno['success']);
            }else{
                $data['erros']['message'] = $retorno['message'];
                $this->template->load('template', 'users/update_user_view', $data);
            }
        }  
   }

    public function get_user($paginacao = NULL){
        $id_page = 5;
        $this->logged->verifica_permissoes($id_page);

        $maximo = 15;
        $inicio = (!$paginacao) ? 0 : $paginacao;
        $config['base_url'] = base_url ('users/get_user');
        $config['per_page'] = $maximo;
        $config['total_rows'] = $this->Users_model->numero_registros();
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $this->pagination->initialize($config); 
        $data['paginacao'] = $this->pagination->create_links();
        $data['users'] = $this->Users_model->get_user($maximo, $inicio);
        $data["numero_registros"] = $config['total_rows'];
        $this->template->load('template', 'users/get_user_view', $data);
    }

    public function visualizar_user(){
            $data['ldap'] = $this->Users_model->get_ldap();
            $data['permission'] = $this->Users_model->get_permission($id);        
    
            if($this->uri->segment(3)){
                $id = $this->uri->segment(3);
            }else{
                $id = $this->input->post('id');
            }
            $data['users'] = $this->Users_model->get_info_user($id);
            $data['users_p'] = $this->Users_model->get_permissions_by_user($id);
            // echo "<pre>";
            // print_r($data);die;
            // echo "</pre>";      
    
            $this->form_validation->set_rules('name', 'Nome', 'required');
            $this->form_validation->set_rules('user_ldap', 'Usuário LDAP', 'required');
            $this->form_validation->set_rules('id_ldap', 'LDAP', 'required');
    
            if ($this->form_validation->run() == FALSE) {
                $data['erros'] = array('message' => validation_errors());
                $this->template->load('template', 'users/visualizar_user_view', $data);
            }
    }

    public function get_user_by_id(){
        $id = file_get_contents('php://input');
        $return = $this->Users_model->get_info_user_logged($id);
        
        echo json_encode($return);
    }

    public function get_permission_user_by_id(){
        $id = file_get_contents('php://input');
        $return = $this->Users_model->get_permission_user_logged($id);
        
        echo json_encode($return);
    }

}
