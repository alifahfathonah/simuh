<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maskapai extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($_SESSION['status'] !="login"){
			
            redirect('login');
        }
		$this->load->model('MaskapaiModel');
	}

	public function tampilData(){
		$data = $this->MaskapaiModel->getData('tb_maskapai');
		echo json_encode($data);
    }
	
	public function tambahMaskapai(){
        $nama = $this->input->post('nama');
		
		$data = array(
            'nama' => $nama
		);

		$tambahMaskapai = $this->MaskapaiModel->simpanData('tb_maskapai', $data);
		return $tambahMaskapai;
	}

	public function dataEditMaskapai(){
		$id = $this->input->post('id');

		$data = $this->MaskapaiModel->getDataEdit('tb_maskapai', $id);
		echo json_encode($data);
	}

	public function simpanEditMaskapai(){
		$id_maskapai = $this->input->post('id');
        $nama = $this->input->post('nama');

		$data = array(
            'nama' => $nama
		);

		$simpanEditMaskapai = $this->MaskapaiModel->updateData('tb_maskapai', $data, 'id_maskapai = "'.$id_maskapai.'"');
		return $simpanEditMaskapai;
	}

	public function deleteMaskapai(){
		$id_maskapai = $this->input->post('id');
		$deleteMaskapai = $this->MaskapaiModel->deleteData('tb_maskapai', 'id_maskapai = "'.$id_maskapai.'"');
		return $deleteMaskapai;
	}

}
