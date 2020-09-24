<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Auth_model');
	}
	
	public function index()
	{
		view('layouts.login');
	}
	
	public function login(){
		if($this->Auth_model->logged_id())
        {
        	redirect("dashboard");
        }else{

			//set form validation
			$this->load->library('form_validation'); 
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {

                //get data dari FORM
                $username = $this->input->post("username", TRUE);
                $password = $this->input->post('password', TRUE);

                $pengacak  = 'HJU12938UIJNBZQZ1';
                $passwordmd = md5($pengacak . md5($password) . $pengacak);

                //checking data via model
                $checking = $this->Auth_model->check_login('tb_admin', array('username' => $username), array('password' => $passwordmd));

                //jika ditemukan, maka create session
                if ($checking != FALSE) {
                    foreach ($checking as $apps) {
                        $session_data = array(
							'id_admin'   => $apps->id_admin,
                            'username' => $apps->username,
                            'nama' => $apps->nama,
                            'status' => 'login'
                        );
                        //set session userdata
                        $this->session->set_userdata($session_data);
                        redirect('dashboard');
                    }
                }else{
					$checking2 = $this->Auth_model->check_login('tb_user', array('username' => $username), array('password' => $passwordmd));
					if ($checking != FALSE) {
						foreach ($checking as $apps) {
							$session_data = array(
								'id_admin'   => $apps->id_user,
								'username' => $apps->username,
								'nama' => $apps->nama,
								'status' => 'login'
							);
							//set session userdata
							$this->session->set_userdata($session_data);
							redirect('dashboard');
						}
					}else{
						redirect('login');	
					}
                }

            }else{

                redirect('login');
			}
		}

	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
