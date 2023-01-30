<?php

class Logged {

    public function get_logged() {
        $CI = & get_instance();
        $CI->load->library('session');
        if ($CI->session->userdata('logged')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function verifica_permissoes($id_page) {
        $CI =& get_instance();
        $CI->load->model('Users_model');
        $CI->load->library('session');

        $id = $CI->session->userdata('id_user');
        $data['permission'] = $CI->Users_model->get_permissions_by_user($id);

        if($this->get_logged()){
            $cont = 0;   

            foreach ($data['permission'] as $p) {
                if($id_page == $p->id_permission){
                    $cont++;
                }
            }
            if($cont == 0){
                redirect(base_url('home/acesso_negado'), 'refresh');
            }else{
                return TRUE;
            }
        }
    }

}
