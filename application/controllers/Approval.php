<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($_SESSION['status'] !="login"){
			
            redirect('login');
        }
		$this->load->model('ApprovalModel');
    }
    
    public function index()
	{
		$data['approval'] = $this->ApprovalModel->getData();
		view('contents.approval.index', $data);
    }

    public function detailApproval($id)
	{
		$data['approval'] = $this->ApprovalModel->getDataById($id);
		view('contents.approval.form', $data);
    }

    public function printApproval($id)
	{
		$data['approval'] = $this->ApprovalModel->getDataById($id);
		view('contents.approval.print', $data);
    }

	public function tampilData(){
		$data = $this->ApprovalModel->getData();
		echo json_encode($data);
    }

	public function tolakApproval(){
		$id_jamaah = $this->input->post('id');
		
		$data = array(
            'approve' => 'ditolak'
		);

		$tolakApproval = $this->ApprovalModel->updateData('tb_jamaah', $data, 'id_jamaah = "'.$id_jamaah.'"');
		return $tolakApproval;
	}

	public function disetujuiApproval(){
		$id_jamaah = $this->input->post('id');
		$bukti_pembayaran = $this->input->post('bukti_pembayaran');
		$jumlah_bayar = $this->input->post('jumlah_bayar');
		$id_head_user = $this->input->post('id_head_user');
		$status = $this->input->post('status');
		
		$data = array(
            'approve' => 'disetujui'
		);

		$disetujuiApproval = $this->ApprovalModel->updateData('tb_jamaah', $data, 'id_jamaah = "'.$id_jamaah.'"');
		if($disetujuiApproval != 0){
			foreach($lastDataJamaah as $dataIdJamaah){
				$dataPembayaran = array(
					'id_jamaah' => $id_jamaah,
					'jumlah_bayar' => $jumlah_bayar,
					'status' => $status,
					'approval' => 'disetujui',
					'tgl' => date('Y-m-d'),
					'bukti_pembayaran' => $bukti_pembayaran
				);
				$tambahPembayaran = $this->DetailPaketModel->simpanData('tb_pembayaran', $dataPembayaran);
			}
		}
		return $disetujuiApproval;
	}

}
