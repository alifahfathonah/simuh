<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailPaket extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// if($_SESSION['status'] !="login"){
			
        //     redirect('login');
        // }
		$this->load->model('DetailPaketModel');
	}

	public function tampilData($id){
		$data = $this->DetailPaketModel->getData($id);
		echo json_encode($data);
    }
	
	public function tambahDetailPaket(){
        $id_paket = $this->input->post('id_paket');
        
        if($this->input->post('maskapai') != '-'){
            $id_maskapai = $this->input->post('maskapai');
        }else{
            $id_maskapai = null;
        }

        if($this->input->post('hotel_makkah') != '-'){
            $id_hotel_makkah = $this->input->post('hotel_makkah');
        }else{
            $id_hotel_makkah = null;
        }

        if($this->input->post('hotel_madina') != '-'){
            $id_hotel_madina = $this->input->post('hotel_madina');
        }else{
            $id_hotel_madina = null;
        }
        
        if($this->input->post('tipe_kamar') != '-'){
            $id_kamar = $this->input->post('tipe_kamar');
        }else{
            $id_kamar = null;
        }        
		
		$data = array(
            'id_paket' => $id_paket,
            'id_maskapai' => $id_maskapai,
            'id_kamar' => $id_kamar
		);

        $tambahDetailPaket = $this->DetailPaketModel->simpanData('tb_detail_paket', $data);
        if($tambahDetailPaket != 0){
            $lastDataDetailPaket = $this->DetailPaketModel->getDataTerakhir('tb_detail_paket', 'id_detail_paket');
            foreach($lastDataDetailPaket as $lastIdPaket){
                $dataPaketHotelMakkah = array(
                    'id_detail_paket' => $lastIdPaket['id_detail_paket'],
                    'id_hotel' => $id_hotel_makkah
                );
                $dataPaketHotelMadina = array(
                    'id_detail_paket' => $lastIdPaket['id_detail_paket'],
                    'id_hotel' => $id_hotel_madina
                );
                $tambahDetailHotelMakkah = $this->DetailPaketModel->simpanData('tb_detail_paket_hotel', $dataPaketHotelMakkah);
                $tambahDetailHotelMadina = $this->DetailPaketModel->simpanData('tb_detail_paket_hotel', $dataPaketHotelMadina);
            }
            
        }
		return $tambahDetailPaket;
	}

	public function deleteDetailPaket(){
        $id_paket = $this->input->post('id');
        $id_paket_detail = $this->db->where('id_paket', $id_paket)->get('tb_detail_paket')->result();
        foreach($id_paket_detail as $id_detail_paket_del){
            $deleteDetailPaketHotel = $this->DetailPaketModel->deleteData('tb_detail_paket_hotel', 'id_detail_paket = "'.$id_detail_paket_del->id_detail_paket.'"');
            $deleteDetailPaket = $this->DetailPaketModel->deleteData('tb_detail_paket', 'id_paket = "'.$id_paket.'"');
        }
		return $deleteDetailPaket;
	}

}
