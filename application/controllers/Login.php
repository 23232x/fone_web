<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->load->view('login/login_view');
    }

    public function authentication() {
        $this->load->model('Login_model');
        
        $dados = $this->input->post();
        $authentication = $this->Login_model->authentication($dados);
        echo json_encode($authentication);

        // $data = file_get_contents('php://input');
        // print_r($data);die;
        // print_r($this->input->post());die;

        // $user_ldap = $this->input->post('user_ldap');
        // $passwd_ldap = $this->input->post('passwd_ldap');

        // print_r($dados);die;
        // if (!$authentication['return']) {
        //     $dados['error'] = $authentication['message'];
        //     $this->load->view('home/', $dados);
        //     $this->template->load('template', 'home/home_view', $dados);
        // //    echo $dados['error'];
        // }

    }

}
