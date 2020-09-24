<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// if($_SESSION['status'] !="login"){
			
        //     redirect('login');
        // }
		$this->load->model('MitraModel');
	}

	public function tampilData(){
		$data = $this->MitraModel->getData();
		echo json_encode($data);
    }

    public function getDataById(){
        $id = $this->input->post('id');
		$data = $this->MitraModel->getDataById($id);
		echo json_encode($data);
    }

}
