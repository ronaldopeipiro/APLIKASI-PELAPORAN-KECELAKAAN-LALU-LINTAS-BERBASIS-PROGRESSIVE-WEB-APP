<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \App\Models\AdminModel;

class Pengaturan extends BaseController
{
	public function __construct()
	{
		$this->AdminModel = new AdminModel();

		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();

		$this->session = session();
		$this->id_user = $this->session->get('id_user');
		$data_user = $this->AdminModel->getAdmin($this->id_user);

		$this->user_nama_lengkap = $data_user['nama_lengkap'];
		$this->user_username = $data_user['username'];
		$this->user_email = $data_user['email'];
		$this->user_no_hp = $data_user['no_hp'];
		$this->user_level = "admin";
		$this->user_status = $data_user['status'];

		if ($data_user['foto'] == '') {
			$this->user_foto = base_url() . "/img/noimg.png";
		} else {
			$this->user_foto = base_url() . "/img/admin/" . $data_user['foto'];
		}
	}

	public function index()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'validation' => $this->validation,
			'title' => 'Pengaturan',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_no_hp' => $this->user_no_hp,
			'user_email' => $this->user_email,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
		];
		return view('administrator/pengaturan/views', $data);
	}

	public function ubah_data_akun()
	{
		$nama_lengkap = $this->request->getPost('nama_lengkap');
		$username = $this->request->getPost('username');
		$email = $this->request->getPost('email');
		$no_hp = $this->request->getPost('no_hp');

		if ($nama_lengkap == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Nama lengkap tidak boleh kosong !'
			));
			return false;
		}

		if ($username == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Username tidak boleh kosong !'
			));
			return false;
		}

		if ($email == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Email tidak boleh kosong !'
			));
			return false;
		}

		$cek_username = $this->db->query("SELECT * FROM tb_admin WHERE id_admin != '$this->id_user' AND username='$username' ");
		if ($cek_username->getNumRows() > 0) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Username telah digunakan !'
			));
			return false;
		}

		$this->AdminModel->updateAdmin([
			'nama_lengkap' => $nama_lengkap,
			'username' => $username,
			'email' => $email,
			'no_hp' => $no_hp
		], $this->id_user);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data akun berhasil diubah !'
		));
	}


	public function ubah_password()
	{
		$password_lama = $this->request->getPost('password_lama');
		$password_baru = $this->request->getPost('password_baru');
		$konfirmasi_password = $this->request->getPost('konfirmasi_password');

		// if ($password_lama == "") {
		// 	echo json_encode(array(
		// 		'success' => '0',
		// 		'pesan' => 'Password lama tidak boleh kosong !'
		// 	));
		// 	return false;
		// }

		if ($password_baru == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Password baru tidak boleh kosong !'
			));
			return false;
		}

		if ($konfirmasi_password == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Konfirmasi password tidak boleh kosong !'
			));
			return false;
		}

		$cek_password_lama = ($this->db->query("SELECT * FROM tb_admin WHERE id_admin='$this->id_user' "))->getRow();
		if (password_verify($password_lama, $cek_password_lama->password)) {
			if ($password_baru == $konfirmasi_password) {
				$password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);
				$this->AdminModel->updateAdmin(
					[
						'password' => $password_baru_hash
					],
					$this->id_user
				);

				echo json_encode(array(
					'success' => '1',
					'pesan' => 'Password berhasil diubah !'
				));
			} else {
				echo json_encode(array(
					'success' => '0',
					'pesan' => 'Password baru yang anda masukkan tidak sesuai dengan konfirmasi !'
				));
				return false;
			}
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Password lama yang anda masukkan salah !'
			));
			return false;
		}
	}


	public function ubah_foto_profil()
	{
		$file_foto = $this->request->getFile('foto');

		$data_lama = $this->AdminModel->getAdmin($this->id_user);

		$nama_foto = $file_foto->getRandomName();
		$file_foto->move('img/admin', $nama_foto);

		// Hapus file lama
		if ($data_lama['foto'] != '') {
			unlink('img/admin/' . $data_lama['foto']);
		}

		$this->AdminModel->updateAdmin([
			'foto' => $nama_foto
		], $this->id_user);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Foto profil berhasil diubah !!!'
		));
	}
}
