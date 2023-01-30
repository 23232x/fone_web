<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logs extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('Logs_model');
        $this->load->model('Contact_model');
        $this->load->model('Users_model');
        $this->load->library('pagination');
        define('LOGGED', $this->logged->get_logged()); // highest automatically-assigned error code
    }

    public function statistical_access_log(){
        if(null == $this->input->post()){
            $data['statistical'] = $this->Logs_model->statistical_access_log();
        }else{
            $data['statistical'] = $this->Logs_model->statistical_access_log($this->input->post());
        }
        $this->template->load('template', 'logs/statistical_access_log_view', $data);
    }

    public function get_logs($paginacao = NULL){
        $maximo = 15;
        $inicio = (!$paginacao) ? 0 : $paginacao;
        $config['base_url'] = base_url ('logs/get_logs');
        $config['per_page'] = $maximo;
        $config['total_rows'] = $this->Logs_model->numero_registros();
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $this->pagination->initialize($config); 
        $data['paginacao'] = $this->pagination->create_links();

        $data['logs'] = $this->Logs_model->get_logs($maximo, $inicio);

        $data["numero_registros"] = $config['total_rows'];
        $this->template->load('template', 'logs/logs_view', $data);
    }

    public function get_logs_acesso($paginacao = NULL){
        $id_user = $this->session->userdata('id_user');

        $maximo = 15;
        $inicio = (!$paginacao) ? 0 : $paginacao;
        $config['base_url'] = base_url ('logs/get_logs_acesso');
        $config['per_page'] = $maximo;
        $config['total_rows'] = $this->Logs_model->numero_registros_a($id_user);
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $this->pagination->initialize($config); 
        $data['paginacao'] = $this->pagination->create_links();

        $data['logs'] = $this->Logs_model->get_logs_acesso($maximo, $inicio);

        $data["numero_registros"] = $config['total_rows'];
        $this->template->load('template', 'logs/logs_acesso_view', $data);
    }


    public function get_logs_inserted($paginacao = NULL){
        $maximo = 15;
        $inicio = (!$paginacao) ? 0 : $paginacao;
        $config['base_url'] = base_url ('logs/get_logs_inserted');
        $config['per_page'] = $maximo;
        $config['total_rows'] = $this->Logs_model->numero_registros_f('Inseriu');
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $this->pagination->initialize($config); 
        $data['paginacao'] = $this->pagination->create_links();

        $data['logs'] = $this->Logs_model->get_logs_inserted($maximo, $inicio);

        $data["numero_registros"] = $config['total_rows'];
        $this->template->load('template', 'logs/logs_view', $data);
    }

    public function get_logs_changed($paginacao = NULL){
        $maximo = 15;
        $inicio = (!$paginacao) ? 0 : $paginacao;
        $config['base_url'] = base_url ('logs/get_logs_changed');
        $config['per_page'] = $maximo;
        $config['total_rows'] = $this->Logs_model->numero_registros_f('Alterou');
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $this->pagination->initialize($config); 
        $data['paginacao'] = $this->pagination->create_links();

        $data['logs'] = $this->Logs_model->get_logs_changed($maximo, $inicio);

        $data["numero_registros"] = $config['total_rows'];
        $this->template->load('template', 'logs/logs_view', $data);
    }

}