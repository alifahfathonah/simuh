<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApprovalModel extends CI_Model {
    public function getData(){
        $data = $this->db->query('
            SELECT
            tb_jamaah.id_jamaah,
            tb_jamaah.jenis_pendaftaran,
            tb_jamaah.keberangkatan,
            tb_jamaah.status,
            tb_jamaah.approval,
            tb_jamaah.tgl_daftar,
            tb_user.*
            FROM
            tb_jamaah
            INNER JOIN tb_user
                ON tb_user.id_user = tb_jamaah.id_user
            WHERE tb_jamaah.approval = "menunggu"
            order by tb_jamaah.no DESC
        ');
        return $data->result();
    }

    public function getDataById($id){
        $data = $this->db->query('
            select
            tb_jamaah.id_jamaah,
            tb_jamaah.jenis_pendaftaran,
            tb_jamaah.keberangkatan,
            tb_jamaah.status,
            tb_jamaah.approval,
            tb_jamaah.tgl_daftar,
            tb_user.*,
            tb_paket.id_paket,
            tb_paket.nama as nama_paket,
            tb_paket.lama,
            tb_paket.bintang,
            tb_maskapai.nama as nama_maskapai,
            tb_kamar.tipe_kamar,
            tb_bukti_transfer.bukti_transfer,
            tb_detail_harga.harga_mitra,
            tb_detail_harga.harga_umum,
            GROUP_CONCAT(tb_hotel.nama SEPARATOR ", ") AS nama_hotel
            from
            tb_jamaah
            inner join tb_user
                on tb_user.id_user = tb_jamaah.id_user
            inner join tb_paket
                on tb_jamaah.id_paket = tb_paket.id_paket
            inner join tb_detail_paket
                on tb_detail_paket.id_paket = tb_paket.id_paket
            inner join tb_maskapai
                on tb_maskapai.id_maskapai = tb_detail_paket.id_maskapai
            inner join tb_kamar
                on tb_kamar.id_kamar = tb_detail_paket.id_kamar
            inner join tb_detail_paket_hotel
                on tb_detail_paket_hotel.id_detail_paket = tb_detail_paket.id_detail_paket
            inner join tb_hotel
                on tb_hotel.id_hotel = tb_detail_paket_hotel.id_hotel
            inner join tb_bukti_transfer
                on tb_bukti_transfer.id_user = tb_user.id_user
            inner JOIN tb_detail_harga
                ON tb_detail_harga.id_paket = tb_paket.id_paket
            where tb_jamaah.approval = "menunggu"
            and tb_jamaah.id_jamaah = "'.$id.'"
        ');
        return $data->result();
    }

    public function cekDataIdMitra($id){
        $data = $this->db->query('
            select
            count(*) as cek
            from
            tb_user
            inner join tb_jamaah
                on tb_jamaah.id_user = tb_user.id_user
            where tb_user.id_user = "'.$id.'"
            and tb_user.mitra_status = "mitra"
        ');
        return $data->result_array();
    }

    public function getDataIdMitra($id){
        $data = $this->db->query('
            select
            *
            from
            tb_user
            inner join tb_jamaah
                on tb_jamaah.id_user = tb_user.id_user
            where tb_user.id_user = "'.$id.'"
            and tb_user.mitra_status = "mitra"
        ');
        return $data->result_array();
    }

    public function getDataIdJamaah($id){
        $data = $this->db->query('
            select
            *
            from
            tb_user
            inner join tb_jamaah
                on tb_jamaah.id_user = tb_user.id_user
            where tb_jamaah.id_jamaah = "'.$id.'"
        ');
        return $data->result_array();
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
