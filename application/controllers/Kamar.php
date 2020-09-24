<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($_SESSION['status'] !="login"){
			
            redirect('login');
        }
		$this->load->model('KamarModel');
	}

	public function tampilData(){
		$data = $this->KamarModel->getData('tb_kamar');
		echo json_encode($data);
    }
	
	public function tambahKamar(){
        $tipe_kamar = $this->input->post('tipe_kamar');
		
		$data = array(
            'tipe_kamar' => $tipe_kamar
		);

		$tambahKamar = $this->KamarModel->simpanData('tb_kamar', $data);
		return $tambahKamar;
	}

	public function dataEditKamar(){
		$id = $this->input->post('id');

		$data = $this->KamarModel->getDataEdit('tb_kamar', $id);
		echo json_encode($data);
	}

	public function simpanEditKamar(){
		$id_kamar = $this->input->post('id');
        $tipe_kamar = $this->input->post('tipe_kamar');
		
		$data = array(
            'tipe_kamar' => $tipe_kamar
		);

		$simpanEditKamar = $this->KamarModel->updateData('tb_kamar', $data, 'id_kamar = "'.$id_kamar.'"');
		return $simpanEditKamar;
	}

	public function deleteKamar(){
		$id_kamar = $this->input->post('id');
		$deleteKamar = $this->KamarModel->deleteData('tb_kamar', 'id_kamar = "'.$id_kamar.'"');
		return $deleteKamar;
	}

}
