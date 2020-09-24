<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranJamaah extends CI_Controller {
    public function __construct(){
		parent::__construct();
		// if($_SESSION['status'] !="login"){
        //     redirect('login');
        // }
		$this->load->model('PendaftaranJamaahModel');
    }
    
	public function index()
	{
		$data['jamaah'] = $this->PendaftaranJamaahModel->getData();
		view('contents.pendaftaran_jamaah.index', $data);
    }
    
    public function add()
	{
		view('contents.pendaftaran_jamaah.form');
	}

	public function tambahJamaah(){
		$id_head_user = $this->input->post('id_head_user');
		$jenis = $this->input->post('jenis');
		$status = $this->input->post('status');
		$id_mitra = $this->input->post('id_mitra');
		$nama = $this->input->post('nama');
		$ktp = $this->input->post('ktp');
		$jk = $this->input->post('jk');
		$no_tlp = $this->input->post('no_tlp');
		$paket = $this->input->post('paket');
		$email = $this->input->post('email');

		$foto = $_FILES['foto']['name'];
		$tmp_foto = $_FILES['foto']['tmp_name'];
		$fototitle = date('dmYHis').$foto;

		$foto_ktp = $_FILES['foto_ktp']['name'];
		$tmp_foto_ktp = $_FILES['foto_ktp']['tmp_name'];
		$fotoktptitle = date('dmYHis').$foto_ktp;

		$bukti = $_FILES['bukti']['name'];
		$tmp_bukti = $_FILES['bukti']['tmp_name'];
		$buktititle = date('dmYHis').$bukti;
		
		// Set path folder tempat menyimpan fotonya
		$path_foto = "upload/foto_profil/".$fototitle;
		$path_ktp = "upload/ktp/".$fotoktptitle;
		$path_bukti = "upload/bukti_transfer/".$buktititle;
		if(move_uploaded_file($tmp_bukti, $path_bukti)){
			if($status == 'umum'){
				if(move_uploaded_file($tmp_foto, $path_foto)){ // Cek apakah gambar berhasil diupload atau tidak
					if(move_uploaded_file($tmp_foto_ktp, $path_ktp)){ // Cek apakah gambar berhasil diupload atau tidak
						$id_user = 'USR'.random_string('numeric', 12);
						$dataUser = array(
							'id_user' => $id_user,
							'id_head_user' => $id_head_user,
							'no_ktp' => $ktp,
							'nama' => $nama,
							'jk' => $jk,
							'foto' => $fototitle,
							'ktp' => $fotoktptitle,
							'mitra_status' => 'nonmitra',
							'no_tlp' => $no_tlp,
							'email' => $email
						);
						$tambahPendaftar = $this->PendaftaranJamaahModel->simpanData('tb_user', $dataUser);
						if($tambahPendaftar != 0){
							$lastData = $this->PendaftaranJamaahModel->getDataTerakhir('tb_user', 'id_user');
							foreach($lastData as $lastIdUser){
								$dataBuktiTransfer = array(
									'id_user' => $lastIdUser['id_user'],
									'bukti_transfer' => $buktititle,
									'tgl' => date('Y-m-d')
								);
								$tambahBuktitransfer = $this->PendaftaranJamaahModel->simpanData('tb_bukti_transfer', $dataBuktiTransfer);
								if($tambahBuktitransfer != 0){
									if($jenis == 'haji'){
										$id_jamaah_haji = 'HAJ'.random_string('numeric', 12);
										$dataJamaahHaji = array(
											'id_jamaah' => $id_jamaah_haji,
											'id_user' => $lastIdUser['id_user'],
											'jenis_pendaftaran' => 'haji',
											'approval' => 'menunggu',
											'tgl_daftar' => date('Y-m-d'),
											'id_paket' => $paket
										);
										$tambahJamaahHaji = $this->PendaftaranJamaahModel->simpanData('tb_jamaah', $dataJamaahHaji);
										if($tambahJamaahHaji != 0){
											$this->session->set_flashdata('sukses', 'disimpan');
											redirect('pendaftaranjamaah');
										} else {
											$this->session->set_flashdata('gagal', 'gagal disimpan');
											redirect('pendaftaranjamaah');
										}
									}else{
										$id_jamaah_umroh = 'UMR'.random_string('numeric', 12);
										$dataJamaahUmroh = array(
											'id_jamaah' => $id_jamaah_umroh,
											'id_user' => $lastIdUser['id_user'],
											'jenis_pendaftaran' => 'haji',
											'approval' => 'menunggu',
											'tgl_daftar' => date('Y-m-d'),
											'id_paket' => $paket
										);
										$tambahJamaahUmroh = $this->PendaftaranJamaahModel->simpanData('tb_jamaah', $dataJamaahUmroh);
										if($tambahJamaahUmroh != 0){
											$this->session->set_flashdata('sukses', 'disimpan');
											redirect('pendaftaranjamaah');
										} else {
											$this->session->set_flashdata('gagal', 'gagal disimpan');
											redirect('pendaftaranjamaah');
										}
									}
								}
							}
						}
					}else{
						// Jika gambar gagal diupload, Lakukan :
						echo "Maaf, Gambar gagal untuk diupload.";
						echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
					}
				}else{
					// Jika gambar gagal diupload, Lakukan :
					echo "Maaf, Gambar gagal untuk diupload.";
					echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
				}
			}else{
				$lastData = $this->PendaftaranJamaahModel->getDataEdit('tb_user', $id_mitra);
				foreach($lastData as $lastIdUser){
					$dataBuktiTransfer = array(
						'id_user' => $lastIdUser->id_user,
						'bukti_transfer' => $buktititle,
						'tgl' => date('Y-m-d')
					);
					$tambahBuktitransfer = $this->PendaftaranJamaahModel->simpanData('tb_bukti_transfer', $dataBuktiTransfer);
					if($tambahBuktitransfer != 0){
						if($jenis == 'haji'){
							$id_jamaah_haji = 'HAJ'.random_string('numeric', 12);
							$dataJamaahHaji = array(
								'id_jamaah' => $id_jamaah_haji,
								'id_user' => $lastIdUser->id_user,
								'jenis_pendaftaran' => 'haji',
								'approval' => 'menunggu',
								'tgl_daftar' => date('Y-m-d'),
								'id_paket' => $paket
							);
							$tambahJamaahHaji = $this->PendaftaranJamaahModel->simpanData('tb_jamaah', $dataJamaahHaji);
							if($tambahJamaahHaji != 0){
								$this->session->set_flashdata('sukses', 'disimpan');
								redirect('pendaftaranjamaah');
							} else {
								$this->session->set_flashdata('gagal', 'gagal disimpan');
								redirect('pendaftaranjamaah');
							}
						}else{
							$id_jamaah_umroh = 'UMR'.random_string('numeric', 12);
							$dataJamaahUmroh = array(
								'id_jamaah' => $id_jamaah_umroh,
								'id_user' => $lastIdUser->id_user,
								'jenis_pendaftaran' => 'haji',
								'approval' => 'menunggu',
								'tgl_daftar' => date('Y-m-d'),
								'id_paket' => $paket
							);
							$tambahJamaahUmroh = $this->PendaftaranJamaahModel->simpanData('tb_jamaah', $dataJamaahUmroh);
							if($tambahJamaahUmroh != 0){
								$this->session->set_flashdata('sukses', 'disimpan');
								redirect('pendaftaranjamaah');
							} else {
								$this->session->set_flashdata('gagal', 'gagal disimpan');
								redirect('pendaftaranjamaah');
							}
						}
					}
				}
			}
		}else{
			// Jika gambar gagal diupload, Lakukan :
			echo "Maaf, Gambar gagal untuk diupload.";
			echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
		}
	}

	public function deletePendaftarJamaah($id_user){
		$deleteUser = $this->PendaftaranJamaahModel->deleteData('tb_user', 'id_user = "'.$id_user.'"');
		$deletePendaftarJamaah = $this->PendaftaranJamaahModel->deleteData('tb_jamaah', 'id_user = "'.$id_user.'"');
		$deleteBuktiTransfer = $this->PendaftaranJamaahModel->deleteData('tb_bukti_transfer', 'id_user = "'.$id_user.'"');
		if($deleteBuktiTransfer != 0){
			$this->session->set_flashdata('sukses', 'disimpan');
			redirect('pendaftaranjamaah');
		} else {
			$this->session->set_flashdata('gagal', 'gagal disimpan');
			redirect('pendaftaranjamaah');
		}
	}
}
