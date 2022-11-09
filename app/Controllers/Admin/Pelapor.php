<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \App\Models\PelaporModel;
use \App\Models\PersonilModel;
use \App\Models\PangkatPersonilModel;
use \App\Models\SatkerPersonilModel;
use \App\Models\LaporanModel;
use \App\Models\FotoLaporanModel;
use \App\Models\KategoriLaporanModel;
use \App\Models\KategoriKorbanModel;
use \App\Models\KategoriKecelakaanModel;
use \App\Models\AdminModel;

class Pelapor extends BaseController
{
	public function __construct()
	{
		$this->PelaporModel = new PelaporModel();
		$this->PersonilModel = new PersonilModel();
		$this->PangkatPersonilModel = new PangkatPersonilModel();
		$this->SatkerPersonilModel = new SatkerPersonilModel();
		$this->LaporanModel = new LaporanModel();
		$this->FotoLaporanModel = new FotoLaporanModel();
		$this->KategoriLaporanModel = new KategoriLaporanModel();
		$this->KategoriKorbanModel = new KategoriKorbanModel();
		$this->KategoriKecelakaanModel = new KategoriKecelakaanModel();
		$this->AdminModel = new AdminModel();
		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();

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
			'title' => 'Pelapor',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_email' => $this->user_email,
			'user_no_hp' => $this->user_no_hp,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'pelapor' => $this->PelaporModel->getPelapor()
		];
		return view('administrator/pelapor/views', $data);
	}
}
