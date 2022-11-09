<?php

namespace App\Controllers\Personil;

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

class DaerahRawan extends BaseController
{
	public function __construct()
	{
		$this->PersonilModel = new PersonilModel();
		$this->PelaporModel = new PelaporModel();
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

		$this->user_latitude = $data_user['latitude'];
		$this->user_longitude = $data_user['longitude'];
	}

	public function index()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'validation' => $this->validation,
			'title' => 'Daerah Rawan',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_nrp' => $this->user_nrp,
			'user_username' => $this->user_username,
			'user_satker' => $this->user_satker,
			'user_pangkat' => $this->user_pangkat,
			'user_jabatan' => $this->user_jabatan,
			'user_no_hp' => $this->user_no_hp,
			'user_email' => $this->user_email,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_latitude' => $this->user_latitude,
			'user_longitude' => $this->user_longitude,
			'user_status_akun' => $this->user_status_akun,
			'user_status_aktif' => $this->user_status_aktif
		];
		return view('personil/daerah-rawan/views', $data);
	}

	public function getDaerahRawan()
	{
		$index = 0;
		$data = [];

		$data_daerah_rawan = $this->LaporanModel->getDaerahRawan();

		foreach ($data_daerah_rawan as $row) {
			$kategori = $this->KategoriLaporanModel->getKategoriLaporan($row['id_kategori_laporan']);
			$pelapor = $this->PelaporModel->getPelapor($row['id_pelapor']);

			if ($row['status'] == "0") {
				$status_text = "Menunggu Respon";
			} elseif ($row['status'] == "1") {
				$status_text = "Telah ditindaklanjuti";
			} elseif ($row['status'] == "2") {
				$status_text = "Tidak ditindaklanjuti";
			}

			if ($row['verifikasi'] == "0") {
				$verifikasi_text = "Belum diverifikasi";
			} elseif ($row['verifikasi'] == "1") {
				$verifikasi_text = "Terverifikasi";
			} elseif ($row['verifikasi'] == "2") {
				$verifikasi_text = "Tidak Terverifikasi";
			}

			$data_foto_pelapor = explode(':', $pelapor['foto']);
			if ($data_foto_pelapor[0] == 'https') {
				$foto_pelapor =	$pelapor['foto'];
			} else {
				$foto_pelapor = base_url() . "/img/pelapor/" . $pelapor['foto'];
			}

			$ClassHome = new \App\Controllers\Home;
			$alamat = $ClassHome->getAddress($row['latitude'], $row['longitude']);

			$data[$index]['token'] = $row['token'];
			$data[$index]['waktu'] = date('d/m/Y H:i:s', strtotime($row['waktu'])) . " WIB";
			$data[$index]['foto_pelapor'] = $foto_pelapor;
			$data[$index]['nama_pelapor'] = $pelapor['nama_lengkap'];
			$data[$index]['email_pelapor'] = $pelapor['email'];
			$data[$index]['id_kategori_laporan'] = $row['id_kategori_laporan'];
			$data[$index]['kategori_laporan'] = $kategori['kategori_laporan'];
			$data[$index]['latitude'] = $row['latitude'];
			$data[$index]['longitude'] = $row['longitude'];
			$data[$index]['alamat'] = $alamat;
			$data[$index]['deskripsi'] = $row['deskripsi'];
			$data[$index]['status'] = $row['status'];
			$data[$index]['status_text'] = $status_text;
			$data[$index]['verifikasi'] = $row['verifikasi'];
			$data[$index]['verifikasi_text'] = $verifikasi_text;
			$index++;
		}
		echo json_encode($data);
	}
}
