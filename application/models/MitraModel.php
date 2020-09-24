<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MitraModel extends CI_Model {
    public function getData(){
        $data = $this->db->query('
            select * from tb_user where tb_user.mitra_status="mitra"
        ');
        return $data->result();
    }

    public function getDataById($id){
        $data = $this->db->query('
            select * from tb_user where tb_user.mitra_status="mitra" and id_user="'.$id.'"
        ');
        return $data->result();
    }
}
