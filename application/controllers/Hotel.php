<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($_SESSION['status'] !="login"){
			
            redirect('login');
        }
		$this->load->model('HotelModel');
	}

	public function tampilDataMakkah(){
		$data = $this->HotelModel->getDataMakkah();
		echo json_encode($data);
    }
    
    public function tampilDataMadina(){
		$data = $this->HotelModel->getDataMadina();
		echo json_encode($data);
	}
	
	public function tambahHotel(){
        $nama = $this->input->post('nama');
        $lokasi = $this->input->post('lokasi');
		
		$data = array(
            'nama' => $nama,
            'lokasi' => $lokasi
		);

		$tambahHotel = $this->HotelModel->simpanData('tb_hotel', $data);
		return $tambahHotel;
	}

	public function dataEditHotel(){
		$id = $this->input->post('id');

		$data = $this->HotelModel->getDataEdit('tb_hotel', $id);
		echo json_encode($data);
	}

	public function simpanEditHotel(){
		$id_hotel = $this->input->post('id');
        $nama = $this->input->post('nama');
        $lokasi = $this->input->post('lokasi');

		$data = array(
            'nama' => $nama,
            'lokasi' => $lokasi
		);

		$simpanEditHotel = $this->HotelModel->updateData('tb_hotel', $data, 'id_hotel = "'.$id_hotel.'"');
		return $simpanEditHotel;
	}

	public function deleteHotel(){
		$id_hotel = $this->input->post('id');
		$deleteHotel = $this->HotelModel->deleteData('tb_hotel', 'id_hotel = "'.$id_hotel.'"');
		return $deleteHotel;
	}

}
