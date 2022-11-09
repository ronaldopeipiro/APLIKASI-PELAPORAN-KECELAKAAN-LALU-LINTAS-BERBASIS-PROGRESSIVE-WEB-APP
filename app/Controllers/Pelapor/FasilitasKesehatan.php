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

class FasilitasKesehatan extends BaseController
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
		$this->db = \Config\Database::connect();

		// $this->keyAPI = "AIzaSyBpc-W4SSnb8kM3cNDK9MYNCucHZdS7Els";
		$this->keyAPI = "AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k";

		$this->session = session();
		$this->google_id = $this->session->get('google_id');
		$data_user = $this->PelaporModel->getPelaporByGoogleId($this->google_id);

		$this->user_id_pelapor = $data_user['id_pelapor'];
		$this->user_nama_lengkap = $data_user['nama_lengkap'];
		$this->user_nik = $data_user['nik'];
		$this->user_username = $data_user['email'];
		$this->user_alamat = $data_user['alamat'];
		$this->user_no_hp = $data_user['no_hp'];
		$this->user_email = $data_user['email'];
		$this->user_latitude = $data_user['latitude'];
		$this->user_longitude = $data_user['longitude'];
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
			'title' => 'Fasilitas Kesehatan',
			'user_google_id' => $this->google_id,
			'user_id_pelapor' => $this->user_id_pelapor,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_nik' => $this->user_nik,
			'user_username' => $this->user_username,
			'user_alamat' => $this->user_alamat,
			'user_no_hp' => $this->user_no_hp,
			'user_email' => $this->user_email,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_latitude' => $this->user_latitude,
			'user_longitude' => $this->user_longitude,
			'user_status' => $this->user_status,
			'keyAPI' => $this->keyAPI,
			// 'laporan' => $this->LaporanModel->getLaporanByIdPelapor($this->google_id)
		];
		return view('pelapor/fasilitas-kesehatan/views', $data);
	}

	public function detail($place_id)
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Fasilitas Kesehatan',
			'user_google_id' => $this->google_id,
			'user_id_pelapor' => $this->user_id_pelapor,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_nik' => $this->user_nik,
			'user_username' => $this->user_username,
			'user_alamat' => $this->user_alamat,
			'user_no_hp' => $this->user_no_hp,
			'user_email' => $this->user_email,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_latitude' => $this->user_latitude,
			'user_longitude' => $this->user_longitude,
			'user_status' => $this->user_status,
			'place_id' => $place_id,
			'keyAPI' => $this->keyAPI,
		];
		return view('pelapor/fasilitas-kesehatan/detail', $data);
	}

	public function distance_matrix_google($lat1, $lng1, $lat2, $lng2)
	{
		$fetch = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations=$lat2%2C$lng2&origins=$lat1%2C$lng1&key=$this->keyAPI");
		$json = json_decode($fetch);

		$data['distance'] = $json->rows[0]->elements[0]->distance->text;;
		$data['duration'] = $json->rows[0]->elements[0]->duration->text;
		$data['duration_in_traffic'] = $json->rows[0]->elements[0]->duration_in_traffic->text;

		return $data;
	}

	public function getNearbyLocationFaskes()
	{
		$index = 0;
		$data = [];

		$poi = $this->request->getPost('poi');
		$koordinat = $this->request->getPost('koordinat');
		$radius = $this->request->getPost('radius');

		$fetch = file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$koordinat&radius=$radius&type=$poi&sensor=true&key=$this->keyAPI");
		$json = json_decode($fetch);
		$limit = (count($json->results) <= 100) ? count($json->results) : 100;

		for ($i = 0; $i < $limit; $i++) {
			$data[$index]['place_id'] = $json->results[$i]->place_id;
			$data[$index]['name'] = $json->results[$i]->name;
			$data[$index]['open_now'] = (isset($json->results[$i]->opening_hours->open_now)) ? $json->results[$i]->opening_hours->open_now : "";
			$data[$index]['lat'] = $json->results[$i]->geometry->location->lat;
			$data[$index]['lng'] = $json->results[$i]->geometry->location->lng;

			$data[$index]['rating'] = (isset($json->results[$i]->rating)) ? $json->results[$i]->rating : 0;
			$data[$index]['rating_total'] = (isset($json->results[$i]->user_ratings_total)) ? $json->results[$i]->user_ratings_total : 0;
			$data[$index]['address'] = $json->results[$i]->vicinity;
			$data[$index]['photo'] = (isset($json->results[$i]->photos)) ? $json->results[$i]->photos[0]->photo_reference : "";
			$data[$index]['icon'] = $json->results[$i]->icon;

			$coordinate = explode(",", $koordinat);
			$distance = $this->distance_matrix_google($coordinate[0], $coordinate[1], $data[$index]['lat'], $data[$index]['lng']);
			$data[$index]['distance'] = $distance['distance'];
			$data[$index]['duration'] = $distance['duration'];
			$data[$index]['duration_in_traffic'] = $distance['duration_in_traffic'];

			$index++;
		}
		echo json_encode($data);
	}

	public function getDetailFaskes()
	{
		$data = [];

		$place_id = $this->request->getPost('place_id');

		$fetch = file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?placeid=$place_id&key=$this->keyAPI");
		$json = json_decode($fetch);

		$data['place_id'] = $place_id;
		$data['name'] = $json->result->name;
		$data['open_now'] = (isset($json->result->opening_hours->open_now)) ? $json->result->opening_hours->open_now : "";
		$data['weekday_text'] = (isset($json->result->opening_hours->weekday_text)) ? $json->result->opening_hours->weekday_text : "";
		$data['lat'] = $json->result->geometry->location->lat;
		$data['lng'] = $json->result->geometry->location->lng;

		$data['rating'] = (isset($json->result->rating)) ? $json->result->rating : 0;
		$data['rating_total'] = (isset($json->result->user_ratings_total)) ? $json->result->user_ratings_total : 0;
		$data['address'] = $json->result->formatted_address;
		$data['formatted_phone_number'] = $json->result->formatted_phone_number;
		$data['photo'] = (isset($json->result->photos)) ? $json->result->photos[0]->photo_reference : "";
		$data['icon'] = $json->result->icon;

		$distance = $this->distance_matrix_google($this->user_latitude, $this->user_longitude, $data['lat'], $data['lng']);
		$data['distance'] = $distance['distance'];
		$data['duration'] = $distance['duration'];
		$data['duration_in_traffic'] = $distance['duration_in_traffic'];

		echo json_encode($data);
	}
}
