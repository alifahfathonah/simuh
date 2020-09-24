<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaketModel extends CI_Model {
    public function getData($tabel){
        $data = $this->db->get($tabel);
        return $data->result();
    }

    public function getDataEdit($tabel, $col, $id){
        $data = $this->db->get_where($tabel, array($col => $id));
        return $data->result();
    }

    public function getDataDetailPaket($id){
        $data = $this->db->query('
            select
            *
            from
            tb_paket
            inner join tb_detail_harga
                on tb_detail_harga.id_paket = tb_paket.id_paket
            where tb_paket.id_paket = "'.$id.'"
        ');
        return $data->result();
    }

    public function getDataDetailPaketNonId(){
        $data = $this->db->query('
            SELECT
            tb_paket.*,
            tb_detail_harga.harga_mitra,
            tb_detail_harga.harga_umum,
            tb_maskapai.nama AS nama_maskapai,
            tb_kamar.tipe_kamar,
            GROUP_CONCAT(tb_hotel.nama SEPARATOR ", ") AS nama_hotel
            FROM
            tb_paket
            left JOIN tb_detail_harga
                ON tb_detail_harga.id_paket = tb_paket.id_paket
            left JOIN tb_detail_paket
                ON tb_detail_paket.id_paket = tb_paket.id_paket
            left JOIN tb_maskapai
                ON tb_detail_paket.id_maskapai = tb_maskapai.id_maskapai
            left JOIN tb_kamar
                ON tb_kamar.id_kamar = tb_detail_paket.id_kamar
            left join tb_detail_paket_hotel
                on tb_detail_paket_hotel.id_detail_paket = tb_detail_paket.id_detail_paket
            left join tb_hotel
                on tb_hotel.id_hotel = tb_detail_paket_hotel.id_hotel
            GROUP BY tb_detail_paket.id_paket ASC
        ');
        return $data->result();
    }

    public function getDataDetailPaketMin($id){
        $data = $this->db->query('
            SELECT
            tb_paket.*,
            tb_detail_harga.harga_mitra,
            tb_detail_harga.harga_umum,
            tb_maskapai.nama AS nama_maskapai,
            tb_kamar.tipe_kamar
            FROM
            tb_paket
            INNER JOIN tb_detail_harga
            ON tb_detail_harga.id_paket = tb_paket.id_paket
            INNER JOIN tb_detail_paket ON tb_detail_paket.id_paket=tb_paket.id_paket
            INNER JOIN tb_maskapai ON tb_detail_paket.id_maskapai=tb_maskapai.id_maskapai
            INNER JOIN tb_kamar ON tb_kamar.id_kamar=tb_detail_paket.id_kamar
            WHERE tb_paket.id_paket = "'.$id.'"
            GROUP BY tb_detail_paket.id_paket ASC
        ');
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
