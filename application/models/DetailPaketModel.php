<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailPaketModel extends CI_Model {
    public function getData($id){
        $data = $this->db->query('
            SELECT
            tb_detail_paket.id_detail_paket,
            tb_paket.*,
            tb_maskapai.id_maskapai,
            tb_maskapai.nama AS nama_maskapai,
            tb_kamar.*,
            tb_hotel.*,
            GROUP_CONCAT(tb_hotel.nama SEPARATOR ", ") AS nama_hotel
            FROM
            tb_detail_paket
            INNER JOIN tb_paket
                ON tb_paket.id_paket = tb_detail_paket.id_paket
            INNER JOIN tb_maskapai
                ON tb_maskapai.id_maskapai = tb_detail_paket.id_maskapai
            INNER JOIN tb_kamar
                ON tb_kamar.id_kamar = tb_detail_paket.id_kamar
            INNER JOIN tb_detail_paket_hotel
            ON tb_detail_paket_hotel.id_detail_paket=tb_detail_paket.id_detail_paket
            INNER JOIN tb_hotel
            ON tb_detail_paket_hotel.id_hotel=tb_hotel.id_hotel
            WHERE tb_paket.id_paket = "'.$id.'"
            GROUP BY tb_hotel.lokasi DESC
        ');
        return $data->result();
    }

    public function getDataEdit($tabel, $col, $id){
        $data = $this->db->get_where($tabel, array($col => $id));
        return $data->result();
    }

    public function getDataTerakhir($tabel, $id){
        $data = $this->db->query("SELECT * FROM ".$tabel." ORDER BY ".$id." DESC limit 1");
        return $data->result_array();
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
