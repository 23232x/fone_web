<?php

class Logs_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Ldap_model');
        $this->load->model('Users_model');
        $this->load->model('Contact_model');
    }

    public function insert_log_access(){
        $date = date("Y-m-d H:i:s");
        $data = array('date'=>$date, 'ip'=>$this->input->ip_address());
        $this->db->insert('statistical_access_log', $data);
    }

    public function statistical_access_log($data = NULL){
        if($data == NULL){
            $date_ini = date('Y-m-d') . ' 00:00:00';
            $date_end = date('Y-m-d') . ' 23:59:59';
        }else{
            $date_ini = $data['date_ini']. ' 00:00:00';
            if($data['date_end'] == null){
                $date_end = date('Y-m-d') . ' 23:59:59';
            }else{
                $date_end = $data['date_end']. ' 23:59:59';
            }
        }
        $this->db->where('date >=', $date_ini);
        $this->db->where('date <=', $date_end);
        $query = $this->db->get('statistical_access_log');
        $return = array('num_rows'=> $query->num_rows(), 'dates'=> array('date_ini'=>$date_ini, 'date_end'=> $date_end));
        return $return;
    }


    function get_logs_inserted($maximo, $inicio){
        $this->db->select('l.id, l.type_logs, l.data_hora, l.ip, c.name as contact_name, u.name as users_name');
        $this->db->from('logs as l');
        $this->db->join('contacts as c', 'c.id = l.id_contact');
        $this->db->join('users as u', 'u.id = l.id_user');
        $this->db->where('l.type_logs', 'Inseriu');
        $this->db->order_by('l.id', 'DESC');
        $this->db->limit($maximo, $inicio);
        $query = $this->db->get();
        return $query->result();
        // echo '<pre>';
        // print_r($query->result());die;
        // echo '</pre>';die;
    }

    function get_logs_changed($maximo, $inicio){
        $this->db->select('l.id, l.type_logs, l.data_hora, l.ip, c.name as contact_name, u.name as users_name');
        $this->db->from('logs as l');
        $this->db->join('contacts as c', 'c.id = l.id_contact');
        $this->db->join('users as u', 'u.id = l.id_user');
        $this->db->where('l.type_logs', 'Alterou');
        $this->db->order_by('l.id', 'DESC');
        $this->db->limit($maximo, $inicio);
        $query = $this->db->get();
        return $query->result();
    }

    function get_logs($maximo, $inicio){
        $this->db->select('l.id, l.type_logs, l.data_hora, l.ip, c.name as contact_name, u.name as users_name');
        $this->db->from('logs as l');
        $this->db->join('contacts as c', 'c.id = l.id_contact');
        $this->db->join('users as u', 'u.id = l.id_user');
        $this->db->order_by('l.id', 'DESC');
        $this->db->limit($maximo, $inicio);
        $query = $this->db->get();
        return $query->result();
    }

    function get_logs_acesso($maximo, $inicio){
        $this->db->select('l.id, l.id_user, l.data_hora, l.ip, u.name as users_name');
        $this->db->from('logs_acesso as l');
        $this->db->join('users as u', 'u.id = l.id_user');
        $this->db->order_by('l.id', 'DESC');        
        $this->db->limit($maximo, $inicio);
        $query = $this->db->get();
        return $query->result();
    }

    function numero_registros(){
        return $this->db->count_all_results('logs');
    }

    function numero_registros_f($cond){
        $this->db->where('type_logs', $cond);
        return $this->db->count_all_results('logs');
    }

    function numero_registros_a($cond){
        $this->db->where('id_user', $cond);
        return $this->db->count_all_results('logs_acesso');
    }

}