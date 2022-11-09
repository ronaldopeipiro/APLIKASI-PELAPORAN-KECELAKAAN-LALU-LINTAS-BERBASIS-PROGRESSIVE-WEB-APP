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
use \App\Models\PushNotifModel;

class Dashboard extends BaseController
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
		$this->PushNotifModel = new PushNotifModel();

		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();

		$this->session = session();
		$this->google_id = $this->session->get('google_id');
		$data_user = $this->PelaporModel->getPelaporByGoogleId($this->google_id);

		$this->user_id_pelapor = $data_user['id_pelapor'];
		$this->user_nama_lengkap = $data_user['nama_lengkap'];
		$this->user_nik = $data_user['nik'];
		$this->user_username = $data_user['email'];
		$this->user_tanggal_lahir = $data_user['tanggal_lahir'];
		$this->user_alamat = $data_user['alamat'];
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

	public function sendTextWA($sender, $receiver, $message)
	{
		$data = [
			'api_key' => '68172c4edaca837ea3c2ff948a57ccc28c9db3a8',
			'sender'  => $sender,
			'number'  => $receiver,
			'message' => $message
		];

		$curl = curl_init();
		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL => "https://wa.infinity15.com/api/send-message.php",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($data)
			)
		);
		$response = curl_exec($curl);
		curl_close($curl);
		// echo $response;
	}

	public function index()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Dashboard Pelapor',
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
		];
		return view('pelapor/dashboard/views', $data);
	}

	public function update_posisi()
	{
		$latitude = $this->request->getPost('latitude');
		$longitude = $this->request->getPost('longitude');

		$this->PelaporModel->updatePelapor([
			'latitude' => $latitude,
			'longitude' => $longitude
		], $this->user_id_pelapor);
	}
}
