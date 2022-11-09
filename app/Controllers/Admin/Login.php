<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\AdminModel;

class Login extends Controller
{
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();
		$this->request = \Config\Services::request();
		$this->AdminModel = new AdminModel();
	}

	public function index()
	{
		helper(['form']);
		$data = [
			'title' => 'LOGIN ADMINISTRATOR',
			'db' => $this->db,
			'validation' => $this->validation
		];
		return view('administrator/sign-in', $data);
	}

	public function auth()
	{
		$session = session();
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$data = ($this->db->query("SELECT * FROM tb_admin WHERE username='$username' LIMIT 1"))->getRow();

		if ($data) {
			$pass = $data->password;
			$status = $data->status;

			if ($status == "1") {
				$verify_pass = password_verify($password, $pass);
				if ($verify_pass) {
					$ses_data = [
						'id_user' => $data->id_admin,
						'logged_in_admin'  => TRUE
					];

					$waktu_login = date("Y-m-d H:i:s");
					$this->AdminModel->updateAdmin([
						'last_login' => $waktu_login
					], $data->id_admin);

					$session->set($ses_data);
					echo json_encode(array(
						'success' => '1',
						'pesan' => 'Selamat Datang ' . $data->nama_lengkap
					));
				} else {
					echo json_encode(array(
						'success' => '0',
						'pesan' => 'Password Salah !'
					));
				}
			} elseif ($status == "0") {
				echo json_encode(array(
					'success' => '0',
					'pesan' => 'Akun anda telah dinonaktifkan !'
				));
			}
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Username tidak ditemukan !'
			));
		}
	}
}
