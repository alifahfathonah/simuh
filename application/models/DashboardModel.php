<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {
    public function getDataJamaahHajiMitra(){
        $data = $this->db->query('
           SELECT
            COUNT(*) as tot
            FROM
            tb_jamaah
            INNER JOIN tb_user
                ON tb_user.id_user = tb_jamaah.id_user
            WHERE tb_user.mitra_status = "mitra"
            AND tb_jamaah.approval = "disetujui"
            AND tb_jamaah.jenis_pendaftaran = "haji"
        ');
        return $data->result();
    }

    public function getDataJamaahHajiUmum(){
        $data = $this->db->query('
           SELECT
            COUNT(*) as tot
            FROM
            tb_jamaah
            INNER JOIN tb_user
                ON tb_user.id_user = tb_jamaah.id_user
            WHERE tb_user.mitra_status = "nonmitra"
            AND tb_jamaah.approval = "disetujui"
            AND tb_jamaah.jenis_pendaftaran = "haji"
        ');
        return $data->result();
    }

    public function getDataJamaahUmrohMitra(){
        $data = $this->db->query('
           SELECT
            COUNT(*) as tot
            FROM
            tb_jamaah
            INNER JOIN tb_user
                ON tb_user.id_user = tb_jamaah.id_user
            WHERE tb_user.mitra_status = "mitra"
            AND tb_jamaah.approval = "disetujui"
            AND tb_jamaah.jenis_pendaftaran = "umroh"
        ');
        return $data->result();
    }

    public function getDataJamaahUmrohUmum(){
        $data = $this->db->query('
           SELECT
            COUNT(*) as tot
            FROM
            tb_jamaah
            INNER JOIN tb_user
                ON tb_user.id_user = tb_jamaah.id_user
            WHERE tb_user.mitra_status = "umum"
            AND tb_jamaah.approval = "disetujui"
            AND tb_jamaah.jenis_pendaftaran = "umroh"
        ');
        return $data->result();
    }

    public function getDataJamaahUmroh(){
        $data = $this->db->query('
           SELECT
            COUNT(*) as tot
            FROM
            tb_jamaah
            INNER JOIN tb_user
                ON tb_user.id_user = tb_jamaah.id_user
            WHERE tb_jamaah.approval = "disetujui"
            AND tb_jamaah.jenis_pendaftaran = "umroh"
        ');
        return $data->result();
    }

    public function getDataJamaahHaji(){
        $data = $this->db->query('
           SELECT
            COUNT(*) as tot
            FROM
            tb_jamaah
            INNER JOIN tb_user
                ON tb_user.id_user = tb_jamaah.id_user
            WHERE tb_jamaah.approval = "disetujui"
            AND tb_jamaah.jenis_pendaftaran = "haji"
        ');
        return $data->result();
    }

    public function getDataJamaah(){
        $data = $this->db->query('
           SELECT
            COUNT(*) as tot
            FROM
            tb_jamaah
            INNER JOIN tb_user
                ON tb_user.id_user = tb_jamaah.id_user
            WHERE tb_jamaah.approval = "disetujui"
        ');
        return $data->result();
    }

    public function getDataApprovalPendaftaran(){
        $data = $this->db->query('
           select
            count(*) as tot
            from
            tb_jamaah
            where approval = "menunggu"
        ');
        return $data->result();
    }

    // public function getDataTabungan(){
    //     $data = $this->db->query('
           
    //     ');
    //     return $data->result();
    // }
}
