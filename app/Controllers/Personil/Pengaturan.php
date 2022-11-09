<?php

namespace App\Controllers\Personil;

use App\Controllers\BaseController;
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
		$this->PersonilModel = new PersonilModel();
		$this->PangkatPersonilModel = new PangkatPersonilModel();
		$this->SatkerPersonilModel = new SatkerPersonilModel();
		$this->LaporanModel = new LaporanModel();
		$this->FotoLaporanModel = new FotoLaporanModel();
		$this->KategoriLaporanModel = new KategoriLaporanModel();
		$this->KategoriKorbanModel = new KategoriKorbanModel();
		$this->KategoriKecelakaanModel = new KategoriKecelakaanModel();
		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();

		$this->session = session();
		$this->id_user = $this->session->get('id_user');
		$data_user = $this->PersonilModel->getPersonil($this->id_user);

		$id_satker = $data_user['id_satker'];
		if ($id_satker != "") {
			$data_satker = $this->SatkerPersonilModel->getSatkerPersonil($id_satker);
			$satker = $data_satker['nama_satker'];
		} else {
			$satker = "";
		}

		$id_pangkat = $data_user['id_pangkat'];
		if ($id_pangkat != "") {
			$data_pangkat = $this->PangkatPersonilModel->getPangkatPersonil($id_pangkat);
			$pangkat = $data_pangkat['singkatan'];
		} else {
			$pangkat = "";
		}

		$this->user_nama_lengkap_np = $data_user['nama_lengkap'];
		$this->user_nama_lengkap = $pangkat . " " . $data_user['nama_lengkap'];
		$this->user_nrp = $data_user['nrp'];
		$this->user_username = $data_user['nrp'];
		$this->user_id_satker = $data_user['id_satker'];
		$this->user_satker = $satker;
		$this->user_id_pangkat = $data_user['id_pangkat'];
		$this->user_pangkat = $pangkat;
		$this->user_jabatan = $data_user['jabatan'];
		$this->user_no_hp = $data_user['no_hp'];
		$this->user_email = $data_user['email'];
		$this->user_level = "personil";

		if ($data_user['foto'] != "") {
			$this->user_foto = base_url() . "/img/personil/" .	$data_user['foto'];
		} else {
			$this->user_foto = base_url() . "/img/noimg.png";
		}

		$this->user_status_akun = $data_user['status_akun'];
		$this->user_status_aktif = $data_user['aktif'];
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
			'user_nama_lengkap_np' => $this->user_nama_lengkap_np,
			'user_nrp' => $this->user_nrp,
			'user_username' => $this->user_username,
			'user_id_satker' => $this->user_id_satker,
			'user_satker' => $this->user_satker,
			'user_id_pangkat' => $this->user_id_pangkat,
			'user_pangkat' => $this->user_pangkat,
			'user_jabatan' => $this->user_jabatan,
			'user_no_hp' => $this->user_no_hp,
			'user_email' => $this->user_email,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status_akun' => $this->user_status_akun,
			'user_status_aktif' => $this->user_status_aktif,
			'satuan_kerja' => $this->SatkerPersonilModel->getSatkerPersonil(),
			'pangkat_personil' => $this->PangkatPersonilModel->getPangkatPersonil()
		];

		return view('personil/pengaturan/views', $data);
	}

	public function ubah_data_akun()
	{
		$nama_lengkap = $this->request->getPost('nama_lengkap');
		$nrp = $this->request->getPost('nrp');
		$id_pangkat = $this->request->getPost('id_pangkat');
		$id_satker = $this->request->getPost('id_satker');
		$email = $this->request->getPost('email');
		$no_hp = $this->request->getPost('no_hp');

		if ($nama_lengkap == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Nama lengkap tidak boleh kosong !'
			));
			return false;
		}

		if ($nrp == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'NRP tidak boleh kosong !'
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

		$cek_nrp = $this->db->query("SELECT * FROM tb_personil WHERE id_personil != '$this->id_user' AND nrp='$nrp' ");
		if ($cek_nrp->getNumRows() > 0) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'NRP telah digunakan !'
			));
			return false;
		}

		$query = $this->PersonilModel->updatePersonil([
			'nama_lengkap' => $nama_lengkap,
			'nrp' => $nrp,
			'id_pangkat' => $id_pangkat,
			'id_satker' => $id_satker,
			'email' => $email,
			'no_hp' => $no_hp
		], $this->id_user);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Data akun berhasil diubah !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Data akun gagal diubah !'
			));
		}
	}


	public function ubah_password()
	{
		$password_lama = $this->request->getPost('password_lama');
		$password_baru = $this->request->getPost('password_baru');
		$konfirmasi_password = $this->request->getPost('konfirmasi_password');

		if ($password_lama == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Password lama tidak boleh kosong !'
			));
			return false;
		}

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

		$cek_password_lama = ($this->db->query("SELECT * FROM tb_personil WHERE id_personil='$this->id_user' "))->getRow();
		if (password_verify($password_lama, $cek_password_lama->password)) {
			if ($password_baru == $konfirmasi_password) {
				$password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);
				$this->PersonilModel->updatePersonil(
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

		$data_lama = $this->PersonilModel->getPersonil($this->id_user);

		$nama_foto = $file_foto->getRandomName();
		$file_foto->move('img/personil', $nama_foto);

		// Hapus file lama
		if ($data_lama['foto'] != '') {
			unlink('img/personil/' . $data_lama['foto']);
		}

		$this->PersonilModel->updatePersonil([
			'foto' => $nama_foto
		], $this->id_user);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Foto profil berhasil diubah !!!'
		));
	}
}
