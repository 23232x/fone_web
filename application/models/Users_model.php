<?php

error_reporting(1);

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function authentication($user = NULL) {
        if ($user != NULL) {
            $this->db->where('user_ldap', $user);
            $this->db->where('status', 1);
            $query = $this->db->get('users');
            if ($query->num_rows() == 1) {
                $return['return'] = TRUE;
                $return['data_user'] = $query->row();
            } else {
                $return['message'] = "Error 003: Falha na autenticação";
                $return['return'] = FALSE;
            }
        } else {
            redirect(base_url());
        }

        return $return;
    }

    function new_user($data = NULL){
        if ($data != NULL) {
            $permissions = $data['permissions'];
            unset($data['permissions']);
            $data['status'] = 1;
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";

            if(isset($data['status'])){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }

            $this->db->trans_start();
            $this->db->insert('users', $data);
            $id = $this->db->insert_id();

            foreach($permissions as $key => $p){
                $array_permission['id_user'] = $id;
                $array_permission['id_permission'] = $key; 
                $this->db->insert('permissions_users', $array_permission);
            }
            $this->db->trans_complete();
           
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $retorno['type'] = FALSE;
                $retorno['message'] = 'Houve um erro ao inserir no banco de dados tente novamente';
            }else{
                $this->db->trans_commit();
                $retorno['type'] = TRUE;
                $retorno['message'] = 'Inserido com sucesso';
            }
                return $retorno;
            } else {
                redirect(base_url());
        }
    }

    function update_user($data = NULL){
        if($data != NULL){
            $permissions = $data['permissions'];
            unset($data['permissions']);

            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            if(isset($data['status'])){
                $data['status'] = 0;
            }else{
                $data['status'] = 1;
            }

            $this->db->where('id', $data['id']);
            $this->db->update('users', $data);

            $this->db->where('id_user', $data['id']);
            $this->db->delete('permissions_users');

            foreach($permissions as $key => $p){
                $array_permission['id_user'] = $data['id'];
                $array_permission['id_permission'] = $key; 
                $this->db->insert('permissions_users', $array_permission);
            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $retorno['type'] = FALSE;
                $retorno['message'] = 'Houve um erro ao inserir no banco de dados tente novamente';
            }else{
                $this->db->trans_commit();
                $retorno['type'] = TRUE;
                $retorno['message'] = 'Inserido com sucesso';
            }
                return $retorno;
            } else {
                redirect(base_url());
        }
    }

    function get_ldap(){
        $query = $this->db->get('ldap');
        return $query->result();
    }

    function get_permission($id){
        $query = $this->db->get('permission');
        return $query->result();
    }

    function get_permissions_by_user($id = NULL){
        if ($id != NULL){
        $this->db->where('id_user', $id);
        $query = $this->db->get('permissions_users');
        return $query->result();
        } else {
            redirect(base_url('home'));
        }
    }

    function get_user($maximo, $inicio){
        $this->db->where("status = ", 1);
        $query = $this->db->get('users', $maximo, $inicio);
        return $query->result();
        // echo "<pre>";
        // print_r($query->result());
        // echo "</pre>";die;
    }

    function numero_registros(){
        $this->db->where('status = ', 1);
        return $this->db->count_all_results('users');
    }

    function get_info_user($id = NULL){
        if($id != NULL){
            $this->db->where('id', $id);
            $query = $this->db->get('users');
            return $query->row();
        } else {
            redirect(base_url('home'));
        }
    }

    function get_users(){
        $query = $this->db->get('users');
        return $query->result();
    }

    function get_permission_one_user($id){
        $this->db->where('id_user', $id);
        $query = $this->db->get('permissions_users');
        return $query->row();
    }

    function get_info_user_logged($id){
        $this->db->select('c.id, c.name, c.user_ldap, c.id_ldap, s.name as name_ldap');
        $this->db->from('users as c'); 
        $this->db->join('ldap as s', 's.id = c.id_ldap');
        $this->db->where('c.id',$id);
        $this->db->where('c.status', 1);
        $query = $this->db->get(); 
        return $query->row();
        // echo "<pre>";
        // print_r($query->row());
        // echo "</pre>";
    }

    function get_permission_user_logged($id){
        $this->db->select('p.id_user as user, p.id_permission as name_permission, i.name');
        $this->db->from('permissions_users as p');
        $this->db->join('permission as i', 'i.id = p.id_permission');
        $this->db->where('p.id_user',$id);
        $query = $this->db->get(); 
        return $query->result();
    }

}

?>