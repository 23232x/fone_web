<?php

error_reporting(1);

class Ldap_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function new_ldap($data = NULL) {
        if ($data != NULL) {
            $valid = $this->valid_ldap($data['domain']);
            if ($valid) {
                $insert = $this->db->insert('ldap', $data);
                if($insert){
                    $return['message'] = 'Inserido com sucesso';
                    $return['type'] = TRUE;
                }else{
                    $return['message'] = 'Houve um erro ao inserir no banco de dados tente novamente';
                    $return['type'] = FALSE;
                }
            } else {
                $return['type'] = FALSE;
                $return['message'] = 'Esse domínio já existe';
            }
            return $return;
        } else {
            redirect(base_url());
        }
    }

    function valid_ldap($domain, $id = NULL) {
        $this->db->where('domain', $domain);
        if($id != NULL){
            $this->db->where('id !=', $id);
        }
        $this->db->where('domain', $domain);
        $query = $this->db->get('ldap');
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function get_ldap(){
        $query = $this->db->get('ldap');
        return $query->result();
    }

    function get_info_ldap($id){
        $this->db->where('id',$id);
        $query = $this->db->get('ldap');
        return $query->row();
    }
    
    function upd_ldap($data) {
        if ($data != NULL) {
        $valid = $this->valid_ldap($data['domain'], $data['id']);
        if ($valid) {
                $this->db->where('id', $data['id']);
                $update = $this->db->update('ldap', $data);
                if($update){
                    $return['message'] = 'Editado com sucesso';
                    $return['type'] = TRUE;
                }else{
                    $return['message'] = 'Houve um erro ao editar no banco de dados tente novamente';
                    $return['type'] = FALSE;
                }
            } else {
                $return['type'] = FALSE;
                $return['message'] = 'Esse domínio já existe';
            }
            return $return;
        } else {
            redirect(base_url());
        }
    }
    
   function connection() {
       $connection = ldap_connect($this->get_server(), $this->get_port());
       if ($connection) {
           $return['return'] = TRUE;
           $return['connection'] = $connection;
       } else {
           $return['return'] = FALSE;
           $return['message'] = "Error 001: Falha na autenticação";
       }
       return $return;
   }

   function authentication($connection, $dados) {
       $user = $dados['user'] . $this->get_domain();
       $password = $dados['password'];
       $bind = ldap_bind($connection, $user, $password);
       if ($bind) {
           $return['return'] = TRUE;
       } else {
           $return['return'] = FALSE;
           $return['message'] = "Error 002: Falha na autenticação";
       }
       return $return;
   }

   function get_domain() {
       $query = $this->db->get('ldap');
       $domain = $query->row()->domain;
       return $domain;
   }

   function get_server() {
       $query = $this->db->get('ldap');
       $server = $query->row()->server;
       return $server;
   }

   function get_port() {
       $query = $this->db->get('ldap');
       $port = $query->row()->port;
       return $port;
   }
}

?>