<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranJamaahModel extends CI_Model {
    public function getData(){
        $data = $this->db->query('
            select
            *
            from
            tb_user
            inner join tb_jamaah
                on tb_jamaah.id_user = tb_user.id_user
        ');
        return $data->result();
    }

    public function getDataTerakhir($tabel, $id){
        $data = $this->db->query("SELECT * FROM ".$tabel." ORDER BY ".$id." DESC limit 1");
        return $data->result_array();
    }

    public function getDataEdit($tabel, $id){
        $data = $this->db->get_where($tabel, array('id_user' => $id));
        return $data->result();
    }

    public function simpanData($tabel, $data){
        $data = $this->db->insert($tabel, $data);
		return $data;
    }

    public function updateData($tabel, $data, $where){
        $data = $this->db->update($tabel, $data, $where);
        return $data;
    }

    public function deleteData($tabel, $where){
        $data = $this->db->delete($tabel, $where);
        return $data;
    }

    public function truncate($tabel){
        $data = $this->db->query('TRUNCATE TABLE '.$tabel);
        return $data;
    }
}
