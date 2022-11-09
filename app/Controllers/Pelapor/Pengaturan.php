<?php

namespace App\Controllers\Pelapor;

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

class Pengaturan extends BaseController
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
		$this->request = \Config\Services::request();
		$this->validation = \Config\Services::validation();
		$this->db = \Config\Database::connect();

		$this->session = session();
		$this->google_id = $this->session->get('google_id');
		$data_user = $this->PelaporModel->getPelaporByGoogleId($this->google_id);

		$this->user_id_pelapor = $data_user['id_pelapor'];
		$this->user_nama_lengkap = $data_user['nama_lengkap'];
		$this->user_nik = $data_user['nik'];
		$this->user_username = $data_user['email'];
		$this->user_alamat = $data_user['alamat'];
		$this->user_tanggal_lahir = $data_user['tanggal_lahir'];
		$this->user_no_hp = $data_user['no_hp'];
		$this->user_email = $data_user['email'];
		$this->user_level = "pelapor";

		$foto_user = explode(':', $data_user['foto']);
		if ($foto_user[0] == 'https') {
			$this->user_foto =	$data_user['foto'];
		} else {
			$this->user_foto = base_url() . "/img/pelapor/" . $data_user['foto'];
		}
		$this->user_status = $data_user['status'];
	}

	public function index()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'validation' => $this->validation,
			'title' => 'Pengaturan',
			'user_google_id' => $this->google_id,
			'user_id_pelapor' => $this->user_id_pelapor,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_nik' => $this->user_nik,
			'user_username' => $this->user_username,
			'user_alamat' => $this->user_alamat,
			'user_tanggal_lahir' => $this->user_tanggal_lahir,
			'user_no_hp' => $this->user_no_hp,
			'user_email' => $this->user_email,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'laporan' => $this->LaporanModel->getLaporanByIdPelapor($this->google_id)
		];
		return view('pelapor/pengaturan/views', $data);
	}

	public function ubah_data_akun()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$id_pelapor = $this->request->getPost('id_pelapor');
		$nama_lengkap = $this->request->getPost('nama_lengkap');
		$nik = $this->request->getPost('nik');
		$tanggal_lahir = $this->request->getPost('tanggal_lahir');
		$no_hp = $this->request->getPost('no_hp');
		$alamat = $this->request->getPost('alamat');

		$cek_nik = $this->db->query("SELECT * FROM tb_pelapor WHERE id_pelapor != '$id_pelapor' AND nik='$nik' ");
		if ($cek_nik->getNumRows() > 0) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'NIK telah terdaftar !'
			));

			return false;
		} else {
			$this->PelaporModel->updatePelapor([
				'nama_lengkap' => $nama_lengkap,
				'nik' => $nik,
				'tanggal_lahir' => $tanggal_lahir,
				'no_hp' => $no_hp,
				'alamat' => $alamat,
				'update_datetime' => $waktu_data
			], $id_pelapor);

			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Data akun berhasil diubah !'
			));
		}
	}

	public function ubah_foto_profil()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$file_foto = $this->request->getFile('foto');

		$data_lama = $this->PelaporModel->getPelapor($this->user_id_pelapor);

		$nama_foto = $file_foto->getRandomName();
		$file_foto->move('img/pelapor', $nama_foto);

		// Hapus file lama
		$cek_foto = explode(':', $data_lama['foto']);
		if ($cek_foto[0] != 'https') {
			unlink('img/pelapor/' . $data_lama['foto']);
		}

		$this->PelaporModel->updatePelapor([
			'foto' => $nama_foto,
			'update_datetime' => $waktu_data
		], $this->user_id_pelapor);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Foto profil berhasil diubah !!!'
		));
	}
}
