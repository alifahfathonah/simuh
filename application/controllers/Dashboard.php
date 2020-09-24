<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($_SESSION['status'] !="login"){
			
            redirect('login');
        }
		$this->load->model('DashboardModel');
    }

	public function index()
	{
		$data['jamaahHajiMitra'] = $this->DashboardModel->getDataJamaahHajiMitra();
		$data['jamaahHajiUmum'] = $this->DashboardModel->getDataJamaahHajiUmum();
		$data['jamaahUmrohMitra'] = $this->DashboardModel->getDataJamaahUmrohMitra();
		$data['jamaahUmrohUmum'] = $this->DashboardModel->getDataJamaahUmrohUmum();
		$data['totJamaahHaji'] = $this->DashboardModel->getDataJamaahUmroh();
		$data['totJamaahUmroh'] = $this->DashboardModel->getDataJamaahHaji();
		$data['totJamaah'] = $this->DashboardModel->getDataJamaah();
		$data['approvePendaftaran'] = $this->DashboardModel->getDataApprovalPendaftaran();
		// $data['tabungan'] = $this->DashboardModel->getDataJamaahHajiMitra();
		view('contents.dashboard.index', $data);
	}
}
