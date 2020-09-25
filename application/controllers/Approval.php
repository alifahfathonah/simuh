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

    // public function printApproval($id)
	// {
	// 	$data['approval'] = $this->ApprovalModel->getDataById($id);
	// 	view('contents.approval.print', $data);
    // }

	public function tampilData(){
		$data = $this->ApprovalModel->getData();
		echo json_encode($data);
    }

	public function tolakApproval(){
		$id_jamaah = $this->input->post('id');
		
		$data = array(
            'approval' => 'ditolak'
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
		$bonus = $this->input->post('bonus');
		
		$data = array(
            'approval' => 'disetujui'
		);

		$disetujuiApproval = $this->ApprovalModel->updateData('tb_jamaah', $data, 'id_jamaah = "'.$id_jamaah.'"');
		if($disetujuiApproval != 0){
			$dataPembayaran = array(
				'id_pembayaran' => $id_jamaah.'-BYR'.random_string('numeric', 3),
				'id_jamaah' => $id_jamaah,
				'jumlah_bayar' => $jumlah_bayar,
				'status' => $status,
				'approval' => 'sudah',
				'tgl' => date('Y-m-d'),
				'bukti_pembayaran' => $bukti_pembayaran
			);
			$tambahPembayaran = $this->ApprovalModel->simpanData('tb_pembayaran', $dataPembayaran);
			if($tambahPembayaran != 0){
				$cekIdMitra = $this->ApprovalModel->cekDataIdMitra($id_head_user);
				foreach($cekIdMitra as $cek){
					if($cek['cek'] != 0){
						$getIdMitra = $this->ApprovalModel->getDataIdMitra($id_head_user);
						foreach($getIdMitra as $id_mitra){
							if($status == 'lunas'){
								$dataBonus = array(
									'id_user' => $id_mitra['id_user'],
									'bonus' => $bonus,
									'tgl_masuk' => date('Y-m-d'),
									'sumber' => 'pendaftaran',
									'jamaah_pendaftar' => $id_jamaah,
									'status' => 'aktif',
									'approval' => 'sudah'
								);
							}else{
								$dataBonus = array(
									'id_user' => $id_mitra['id_user'],
									'bonus' => $bonus,
									'tgl_masuk' => date('Y-m-d'),
									'sumber' => 'pendaftaran',
									'jamaah_pendaftar' => $id_jamaah,
									'status' => 'nonaktif',
									'approval' => 'sudah'
								);
							}
							$tambahBonus = $this->ApprovalModel->simpanData('tb_bonus', $dataBonus);
							if($tambahBonus != 0){
								$this->email->from('seftianandy45@gmail.com', 'Seftian Andy');
								$this->email->to($id_mitra['email']);

								$this->email->subject('Username dan Password Aplikasi SIMUH ibs');
								$this->email->message('Username : '.$id_mitra['id_user'].' - Password : '.$id_mitra['password']);

								$this->email->send();
							}
						}
					}else{
						if($status == 'lunas'){
							$dataKhas = array(
								'id_khas' => 'KS'.random_string('numeric', 6),
								'khas' => $bonus,
								'tgl_masuk' => date('Y-m-d'),
								'sumber' => 'pendaftaran',
								'jamaah_pendaftar' => $id_jamaah,
								'status' => 'aktif'
							);
						}else{
							$dataKhas = array(
								'id_khas' => 'KS'.random_string('numeric', 6),
								'khas' => $bonus,
								'tgl_masuk' => date('Y-m-d'),
								'sumber' => 'pendaftaran',
								'jamaah_pendaftar' => $id_jamaah,
								'status' => 'nonaktif'
							);
						}
						$tambahKhas = $this->ApprovalModel->simpanData('tb_khas', $dataKhas);
						if($tambahKhas != 0){
							$getIdJamaah = $this->ApprovalModel->getDataIdJamaah($id_jamaah);
							foreach($getIdJamaah as $idJamaah)
							$this->email->from('seftianandy45@gmail.com', 'Seftian Andy');
							$this->email->to($id_mitra['email']);

							$this->email->subject('Username dan Password Aplikasi SIMUH ibs');
							$this->email->message('Username : '.$idJamaah['id_user'].' - Password : '.$idJamaah['password']);

							$this->email->send();
						}
					}
				}
			}
		}
		return $disetujuiApproval;
	}

}
