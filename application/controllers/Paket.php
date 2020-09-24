<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {
    public function __construct(){
		parent::__construct();
		// if($_SESSION['status'] !="login"){
        //     redirect('login');
        // }
        $this->load->model('PaketModel');
        $this->load->model('DetailPaketModel');
    }
    
	public function index()
	{
        $data['dataPaket'] = $this->PaketModel->getDataDetailPaketNonId();
        view('contents.paket.index', $data);
        // var_dump($data);
    }

    public function tampilData(){
		$data = $this->PaketModel->getDataDetailPaketNonId();
		echo json_encode($data);
    }
    
    public function tampilDataDetail(){
        $id = $this->input->post('id');
		$data = $this->PaketModel->getDataDetailPaketMin($id);
		echo json_encode($data);
    }
    
    public function add()
	{
		view('contents.paket.form');
    }
    
    public function edit($id)
	{
        $data['dataPaket'] = $this->PaketModel->getDataDetailPaket($id);
		view('contents.paket.detail', $data);
    }
	
	public function tambahPaket(){
        $nama = $this->input->post('nama');
        $bintang = $this->input->post('bintang');
        $lama = $this->input->post('lama');
        $harga_mitra = $this->input->post('harga_mitra');
        $harga_umum = $this->input->post('harga_umum');
		
		$dataPaket = array(
            'nama' => $nama,
            'lama' => $lama,
            'bintang' => $bintang
        );
        $tambahPaket = $this->PaketModel->simpanData('tb_paket', $dataPaket);
        if($tambahPaket != 0){
            $dataTerakhir	=	$this->PaketModel->getDataTerakhir('tb_paket', 'id_paket');
            foreach($dataTerakhir as $lastData){
                $dataHarga = array(
                    'id_paket' => $lastData['id_paket'],
                    'harga_mitra' => $harga_mitra,
                    'harga_umum' => $harga_umum
                );
                $tambahHarga = $this->PaketModel->simpanData('tb_detail_harga', $dataHarga);
                if($tambahHarga != 0){
                    $this->session->set_flashdata('success', 'saved');
                    redirect('formdetailpaket/'.$lastData['id_paket']);
                }
            }
        }
	}

	public function deletePaket(){
		$id_paket = $this->input->post('id');
        $deletePaket = $this->PaketModel->deleteData('tb_paket', 'id_paket = "'.$id_paket.'"');
        $id_paket_detail = $this->db->where('id_paket', $id_paket)->get('tb_detail_paket')->result();
        foreach($id_paket_detail as $id_detail_paket_del){
            $deleteDetailPaketHotel = $this->DetailPaketModel->deleteData('tb_detail_paket_hotel', 'id_detail_paket = "'.$id_detail_paket_del->id_detail_paket.'"');
            $deleteDetailPaket = $this->DetailPaketModel->deleteData('tb_detail_paket', 'id_paket = "'.$id_paket.'"');
        }
		return $deletePaket;
	}
}
