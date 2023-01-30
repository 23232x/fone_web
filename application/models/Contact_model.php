<?php

error_reporting(1);

class Contact_model extends CI_Model {

    function __construct() { 
        parent::__construct();
        $this->load->model('Logs_model');
    }

    function new_contact($data = NULL) {
        if ($data != NULL) {
            // $id_log = $this->Logs_model->id_type_log();
            // print_r($id_log);die;
            $data['status'] = 1;

            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            if(isset($data['confidential'])){
                $data['confidential'] = 1;
            }else{
                $data['confidential'] = 0;
            }

            unset($data['id_secretary']);

            $insert = $this->db->insert('contacts', $data);

            $hora = date("Y-m-d H:i:s");
            $ip = $this->input->ip_address();
            $id_user = $this->session->userdata('id_user');
            $id = $this->db->insert_id();

            $this->db->set('id_user', $id_user);
            $this->db->set('type_logs', 'Inseriu');
            $this->db->set('id_contact', $id);
            $this->db->set('data_hora', $hora);
            $this->db->set('ip', $ip);
            $this->db->insert('logs');

            $this->db->trans_complete();

            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $return['message'] = 'Houve um erro ao inserir no banco de dados tente novamente';
                $return['type'] = FALSE;
            }else{
                $this->db->trans_commit();
                $return['message'] = 'Inserido com sucesso';
                $return['type'] = TRUE;
            }
            return $return;
        }else{
            redirect(base_url());
        }
    }

    function new_secretary(){
        $this->db->order_by('name');
        $query = $this->db->get('secretary');
        return $query->result();
    }

    function get_contact($maximo, $inicio){

        $id = $this->session->userdata('id_user');
        $data = $this->Users_model->get_permission_one_user($id);
        // print_r($data);die;

        if($data->id_permission == 1){
            $this->db->select('c.id, c.name, c.email, c.number, d.name as department, s.name as secretary');
            $this->db->from('contacts as c');
            $this->db->join('departments as d', 'd.id = c.id_department');
            $this->db->join('secretary as s', 's.id = d.id_secretary');
            // $this->db->like('name', $name);
            $this->db->like('c.name'); 
            $this->db->or_like('c.number');
            $this->db->limit($maximo, $inicio);
            $query = $this->db->get();
            return $query->result();
            // $query = $this->db->get();
        }else{
            $this->db->select('c.id, c.name, c.email, c.number, d.name as department, s.name as secretary');
            $this->db->from('contacts as c');
            $this->db->join('departments as d', 'd.id = c.id_department');
            $this->db->join('secretary as s', 's.id = d.id_secretary');
            // $this->db->like('name', $name);
            $this->db->like('name'); 
            $this->db->where('c.confidential', 0); // nao confidenciais
            $this->db->where('c.confidential', 0); // nao confidenciais
            $this->db->or_like('c.number');
            $this->db->where('c.confidential', 0); // nao confidenciais
            $this->db->limit($maximo, $inicio);
            $query = $this->db->get();
            return $query->result();
            // $query = $this->db->get();
        }

        // $query = $this->db->get('contacts', $maximo, $inicio);
        // return $query->result();
    }

    function order_by_name($maximo, $inicio){
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('contacts', $maximo, $inicio);
        return $query->result();
    }

    function numero_registros(){
        $id = $this->session->userdata('id_user');
        $data = $this->Users_model->get_permission_one_user($id);

        if($data->id_permission == 1){
            return $this->db->count_all_results('contacts');
        }else{
            $this->db->where('confidential', 0);
            return $this->db->count_all_results('contacts');
        }

        // return $this->db->count_all_results('contacts');
    }

    function get_info_contact($id){
        // $this->db->where('id',$id);
        // $query = $this->db->get('contacts');
        // return $query->row();
        $this->db->select('c.id, c.name, c.status, c.email, s.id as secretary , c.id_department as department, d.name as department_name, c.number, c.confidential, s.name as name_secretary');
        $this->db->from('contacts as c');
        $this->db->join('departments as d', 'd.id = c.id_department');
        $this->db->join('secretary as s', 's.id = d.id_secretary');
        $this->db->where('c.id',$id);
        //$this->db->where('c.status', 1);
        $query = $this->db->get(); 
        return $query->row();
    }

    function upd_contact($data) {
        if ($data != NULL) {
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            if(isset($data['confidential'])){
                $data['confidential'] = 1;
            }else{
                $data['confidential'] = 0;
	    }
	    if(isset($data['status'])){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            unset($data['id_secretary']);
            $this->db->where('id', $data['id']);
            $update = $this->db->update('contacts', $data);
            // print_r($data);die;

            $hora = date("Y-m-d H:i:s");
            $ip = $this->input->ip_address();
            $id_user = $this->session->userdata('id_user');
            // $id = $this->db->insert_id();

            $this->db->set('id_user', $id_user);
            $this->db->set('type_logs', 'Alterou');
            $this->db->set('id_contact', $data['id']);
            // print_r($data['id']);die;
            $this->db->set('data_hora', $hora);
            $this->db->set('ip', $ip);
            $this->db->insert('logs');

            $this->db->trans_complete();

            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $return['message'] = 'Houve um erro ao editar, tente novamente';
                $return['type'] = FALSE;
            }else{
                $this->db->trans_commit();
                $return['message'] = 'Editado com sucesso';
                $return['type'] = TRUE;
            }
                return $return;
            }else{
        redirect(base_url());
        }
    }

    function get_contact_by_name($name){
        // $query = $this->db->get('contacts');
        // $this->db->like('title', $name);

        $id = $this->session->userdata('id_user');
        $data = $this->Users_model->get_permission_one_user($id);
        // print_r($data);die;

        if($data->id_permission == 1){
            $this->db->select('c.id, c.name, c.email, c.status, c.number, d.name as department_name, s.name as secretary');
            $this->db->from('contacts as c');
            $this->db->join('departments as d', 'd.id = c.id_department');
            $this->db->join('secretary as s', 's.id = d.id_secretary');
            $this->db->like('c.name', $name); 
            $this->db->or_like('c.number', $name);
            $this->db->or_like('d.name', $name);
	    $this->db->or_like('s.name', $name);
            $query = $this->db->get();
        }else{
            $this->db->select('c.id, c.name, c.email, c.status, c.number, d.name as department_name, s.name as secretary');
            $this->db->from('contacts as c');
            $this->db->join('departments as d', 'd.id = c.id_department');
            $this->db->join('secretary as s', 's.id = d.id_secretary');
            $this->db->like('c.name', $name); 
            $this->db->where('c.confidential', 0); // nao confidenciais
            $this->db->or_like('c.number', $name);
            $this->db->or_like('d.name', $name);
            $this->db->or_like('s.name', $name);
            $query = $this->db->get();
        }

        /*$array_names_contact = array();
        foreach ($query->result() as $contact){
            array_push($array_names_contact, array("name"=> $contact->name, "departament"=> $contact->departament, "number"=> $contact->number));
        }*/
        // print_r($query->result());
        // die;
        return $query->result();
    
    }

    public function get_contacts_home(){
        $this->db->select('id, name');
        $this->db->where('status', 1);
        $this->db->order_by('name');
        $query = $this->db->get('secretary');
        $secretariats = $query->result();
        $result = array();
        foreach($secretariats as $secretary){
            $contacts = $this->get_contact_by_secretary($secretary->id);
            array_push($result, array('secretary'=>$secretary,'data_contacts'=> $contacts));
        }
        return $result;
    }

    private function get_contact_by_secretary($id_secretary){
        $this->db->select('c.id, c.name, c.email, s.id as secretary , c.id_department as department, d.name as department_name, d.general_secretary, c.number, c.confidential, s.name as name_secretary');
        $this->db->from('contacts as c');
        $this->db->join('departments as d', 'd.id = c.id_department');
        $this->db->join('secretary as s', 's.id = d.id_secretary');
        $this->db->where('s.id',$id_secretary);
        $this->db->where('c.status', 1);
        $this->db->order_by('d.general_secretary', 'DESC');
        $this->db->order_by('d.name');
        $this->db->order_by('c.name');
        $query = $this->db->get(); 
        return $query->result();
    }

}
?>
