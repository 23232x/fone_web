<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contact_model');
        $this->load->model('Users_model');
        $this->load->library('pagination');
        define('LOGGED', $this->logged->get_logged()); // highest automatically-assigned error code
    }

    public function get_contacts() {
        $typed = file_get_contents('php://input');
        $return = $this->get_contact_by_name($typed);

        // $return['contacts'] = $this->Contact_model->search_contact();        

        // $return = array();

        // $return[0]['name'] = 'Pablo';
        // $return[0]['number'] = '204';
        // $return[0]['email'] = 'pablosesterheim@sapiranga.rs.gov.br';
        // $return[0]['departament'] = 'Informática';
        
        echo json_encode($return);
    }

    public function get_contact_by_name($name){
        $typed = $this->Contact_model->get_contact_by_name($name);
        return $typed;
    }

    public function get_contact_by_id(){
        $id = file_get_contents('php://input');
        $return = $this->Contact_model->get_info_contact($id);

        echo json_encode($return);
        // return $data;
        // print_r($data);
    }


    public function new_contact() {
        $id_page = 2;
        $this->logged->verifica_permissoes($id_page);

        $data['secretary'] = $this->Contact_model->new_secretary();
        // $this->template->load('template', 'contacts/new_contact_view', $data);

        $data['inputs'] = $this->input->post();

        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('id_department', 'Departamento', 'required');
        $this->form_validation->set_rules('id_secretary', 'Secretaria', 'required');
        $this->form_validation->set_rules('number', 'Número', 'required');
        $this->form_validation->set_rules('confidential', 'Confidencial');

        if ($this->form_validation->run() == FALSE) {
            $data['erros'] = array('message' => validation_errors());
            $this->template->load('template', 'contacts/new_contact_view', $data);
        }else{
            $this->load->model('Contact_model');
            $insert = $this->Contact_model->new_contact($this->input->post());
            if($insert['type']){
                $data['success']['message'] = $insert['message'];
                // $this->get_contact(NULL, $retorno['success']);
                $this->template->load('template', 'contacts/new_contact_view', $data);
            }else{
                $data['erros']['message'] = $insert['message'];
                $this->template->load('template', 'contacts/new_contact_view', $data);
            }
        }  
    }

    public function get_contact($paginacao = NULL){
        $id_page = 3;
        $this->logged->verifica_permissoes($id_page);
        $this->template->load('template', 'contacts/get_contact_view');
    }

    public function order_by_name($paginacao = NULL){
        $id_page = 3;
        $this->logged->verifica_permissoes($id_page);

        // $data['contacts'] = $this->Contact_model->get_contact();
        $maximo = 15;
        $inicio = (!$paginacao) ? 0 : $paginacao;
        $config['base_url'] = base_url ('contacts/order_by_name');
        $config['per_page'] = $maximo;
        $config['total_rows'] = $this->Contact_model->numero_registros();
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $this->pagination->initialize($config); 
        
        $data['paginacao'] = $this->pagination->create_links();
        $data['contacts'] = $this->Contact_model->order_by_name($maximo, $inicio);

        $data["numero_registros"] = $config['total_rows'];
        $this->template->load('template', 'contacts/get_contact_view', $data);
    }

    public function update_contact() {
        $data['secretary'] = $this->Contact_model->new_secretary();

        if($this->uri->segment(3)){
            $id = $this->uri->segment(3);
        }else{
            $id = $this->input->post('id');
        }
        $data['contacts'] = $this->Contact_model->get_info_contact($id);

        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('id_department', 'Departamento', 'required');
        $this->form_validation->set_rules('id_secretary', 'Secretaria', 'required');
        $this->form_validation->set_rules('number', 'Número', 'required');
        $this->form_validation->set_rules('confidential', 'Confidencial');

        if ($this->form_validation->run() == FALSE) {
            $data['erros'] = array('message' => validation_errors());
            $this->template->load('template', 'contacts/update_contact_view', $data);
        }else{
            $this->load->model('Contact_model');
            $insert = $this->Contact_model->upd_contact($this->input->post());
            if($insert['type']){
                $this->session->set_flashdata('msg_success', $insert['message']);
                redirect(base_url('contacts/get_contact'));
            }else{
                $data['erros']['message'] = $insert['message'];
                $this->template->load('template', 'contacts/update_contact_view', $data);
            }
            
        }  
    }

    public function visualizar_contact(){
        $data['secretary'] = $this->Contact_model->new_secretary();

        if($this->uri->segment(3)){
            $id = $this->uri->segment(3);
        }else{
            $id = $this->input->post('id');
        }
        $data['contacts'] = $this->Contact_model->get_info_contact($id);

        if ($this->form_validation->run() == FALSE) {
            $data['erros'] = array('message' => validation_errors());
            $this->template->load('template', 'contacts/visualizar_contact_view', $data);
        }
    }

}
