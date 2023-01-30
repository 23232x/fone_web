<?php

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Ldap_model');
        $this->load->model('Users_model');
    }

    function authentication($dados = NULL) {
        if ($dados != NULL) {
            $connection_ldap = $this->Ldap_model->connection();
            if ($connection_ldap['return']) {
                $authentication_ldap = $this->Ldap_model->authentication($connection_ldap['connection'], $dados);
                if ($authentication_ldap['return']) {
                    $authentication_db = $this->Users_model->authentication($dados['user']);
                    if ($authentication_db['return']) {
                        if ($dados['user'] == $authentication_db['data_user']->user_ldap) {
                            $this->insert_session($authentication_db['data_user']);
                            $return['return'] = TRUE;
                        } else {
                            $return['return'] = FALSE;
                            $return['message'] = "Error 004: Falha na autenticação";
                        }
                    } else {
                        $return['return'] = FALSE;
                        $return['message'] = $authentication_db['message'];
                    }
                } else {
                    $return['return'] = FALSE;
                    $return['message'] = $authentication_ldap['message'];
                }
            } else {
                $return['return'] = FALSE;
                $return['message'] = $connection_ldap['message'];
            }
        } else {
            redirect(base_url());
        }
        return $return;
    }
    
    function insert_session($data_user) {
        $data = array(
        'user' => $data_user->user_ldap,
        'logged' => TRUE,
        'id_user' => $data_user->id,
        'status' => $data_user->status
        );
        $hora = date("Y-m-d H:i:s");
        $ip = $this->input->ip_address();
        // $id_user = $this->session->userdata('id_user');

        $this->db->set('id_user', $data['id_user']);
        $this->db->set('data_hora', $hora);
        $this->db->set('ip', $ip);
        $this->db->insert('logs_acesso');

        $this->session->set_userdata($data);
    }

}

?>