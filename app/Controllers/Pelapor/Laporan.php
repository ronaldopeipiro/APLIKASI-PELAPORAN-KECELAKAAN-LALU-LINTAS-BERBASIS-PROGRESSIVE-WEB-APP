<?php

namespace App\Controllers\Pelapor;

use App\Controllers\BaseController;
use \App\Models\PelaporModel;
use \App\Models\PersonilModel;
use \App\Models\PangkatPersonilModel;
use \App\Models\SatkerPersonilModel;
use \App\Models\LaporanModel;
use \App\Models\LaporanKorbanModel;
use \App\Models\FotoLaporanModel;
use \App\Models\KategoriLaporanModel;
use \App\Models\KategoriKorbanModel;
use \App\Models\KategoriKecelakaanModel;

class Laporan extends BaseController
{
	public function __construct()
	{
		$this->PelaporModel = new PelaporModel();
		$this->PersonilModel = new PersonilModel();
		$this->PangkatPersonilModel = new PangkatPersonilModel();
		$this->SatkerPersonilModel = new SatkerPersonilModel();
		$this->LaporanModel = new LaporanModel();
		$this->LaporanKorbanModel = new LaporanKorbanModel();
		$this->FotoLaporanModel = new FotoLaporanModel();
		$this->KategoriLaporanModel = new KategoriLaporanModel();
		$this->KategoriKorbanModel = new KategoriKorbanModel();
		$this->KategoriKecelakaanModel = new KategoriKecelakaanModel();
		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();

		$this->keyAPI = "AIzaSyB-JpweDJ7_cA9-KiEq-iMjQzlluOemnWo";

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
			'title' => 'Laporan',
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
			'user_latitude' => $this->user_latitude,
			'user_longitude' => $this->user_longitude,
			'user_status' => $this->user_status,
		];
		return view('pelapor/laporan/views', $data);
	}

	public function detail($token)
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Detail Laporan',
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
			'laporan' => $this->LaporanModel->getLaporanByToken($token),
			'data_kategori_korban' => $this->KategoriKorbanModel->getKategoriKorban()
		];
		return view('pelapor/laporan/detail', $data);
	}

	public function edit($token)
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Edit Laporan',
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
			'laporan' => $this->LaporanModel->getLaporanByToken($token)
		];
		return view('pelapor/laporan/edit', $data);
	}

	public function history()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'History',
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
			'user_latitude' => $this->user_latitude,
			'user_longitude' => $this->user_longitude,
			'user_status' => $this->user_status,
		];
		return view('pelapor/history/views', $data);
	}


	public function create_laporan()
	{
		$tanggal_now = date("Y-m-d");
		$waktu_data = date("Y-m-d H:i:s");
		$id_kategori_laporan = $this->request->getPost('id_kategori_laporan');

		$id_pelapor = $this->user_id_pelapor;
		$latitude = $this->user_latitude;
		$longitude = $this->user_longitude;

		$cek_data = $this->db->query("SELECT * FROM tb_laporan WHERE id_pelapor='$id_pelapor' AND latitude='$latitude' AND longitude='$longitude' AND DATE(waktu) = '$tanggal_now' ");

		$class_login = new \App\Controllers\Pelapor\Login;
		$token = $class_login->getToken(37);

		if ($cek_data->getNumRows() == 0) {
			$this->LaporanModel->save([
				'token' => $token,
				'id_pelapor' => $id_pelapor,
				'id_kategori_laporan' => $id_kategori_laporan,
				'latitude' => $latitude,
				'longitude' => $longitude,
				'status' => '0',
				'verifikasi' => '0'
			]);
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Laporan berhasil dibuat'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Gagal membuat laporan, Anda baru saja membuat laporan di lokasi ini !'
			));
		}
	}

	public function ubah_koordinat_laporan()
	{
		$tanggal_now = date("Y-m-d");
		$waktu_data = date("Y-m-d H:i:s");
		$id_laporan = $this->request->getPost('id_laporan');
		$latitude = $this->request->getPost('latitude');
		$longitude = $this->request->getPost('longitude');

		$query = $this->LaporanModel->save([
			'id_laporan' => $id_laporan,
			'latitude' => $latitude,
			'longitude' => $longitude,
		]);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Koordinat laporan berhasil diubah !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Koordinat laporan gagal diubah !'
			));
		}
	}

	public function cancel_laporan()
	{
		$id_laporan = $this->request->getPost('id_laporan');

		// Hapus semua foto tindakan
		$data_foto_tindakan = $this->db->query("SELECT * FROM tb_foto_tindakan_personil WHERE id_tindakan IN (SELECT id_tindakan FROM tb_tindakan_personil WHERE id_laporan = '$id_laporan') ");
		foreach ($data_foto_tindakan->getResult('array') as $row) {
			$id_foto = $row['id_foto'];
			$foto = $row['foto'];
			unlink('img/laporan/tindakan/' . $foto);

			$this->db->query("DELETE FROM tb_foto_tindakan_personil WHERE id_foto='$id_foto' ");
		}
		// Hapus semua tindakan
		$this->db->query("DELETE FROM tb_tindakan_personil WHERE id_laporan = '$id_laporan' ");

		$query = $this->LaporanModel->deleteLaporan($id_laporan);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Laporan dibatalkan !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Terjadi kesalahan teknis !'
			));
		}
	}


	public function getLaporanMasuk()
	{
		$jenis_data = $this->request->getPost('jenis_data');

		$index = 0;
		$data = [];

		if ($jenis_data == "today") {
			$date_today = date('Y-m-d');
			$data_laporan = $this->db->query("SELECT * FROM tb_laporan WHERE id_pelapor='$this->user_id_pelapor' AND DATE(waktu) = '$date_today' ORDER BY id_laporan DESC ");
		} elseif ($jenis_data == "periodic") {
			$start_date = $this->request->getPost('start_date');
			$end_date = $this->request->getPost('end_date');
			$data_laporan = $this->db->query("SELECT * FROM tb_laporan WHERE id_pelapor='$this->user_id_pelapor' AND waktu BETWEEN '$start_date' AND '$end_date' ORDER BY id_laporan DESC ");
		} elseif ($jenis_data == "all") {
			$data_laporan = $this->db->query("SELECT * FROM tb_laporan WHERE id_pelapor='$this->user_id_pelapor' ORDER BY id_laporan DESC ");
		}

		foreach ($data_laporan->getResult('array') as $row) {
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
			$data[$index]['waktu'] = strftime('%d/%m/%Y %H:%M:%S', strtotime($row['waktu'])) . " WIB";
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


	// Foto

	public function tambah_foto_laporan()
	{
		$id_laporan = $this->request->getPost('id_laporan');
		$file_foto = $this->request->getFile('foto');
		$deskripsi = $this->request->getPost('deskripsi');
		$latitude = $this->request->getPost('latitude');
		$longitude = $this->request->getPost('longitude');

		$nama_foto = $file_foto->getRandomName();
		// $file_foto->move('img/laporan/kejadian', $nama_foto);

		// Image manipulation
		$image = \Config\Services::image()
			->withFile($file_foto)
			->withResource()
			->save('img/laporan/kejadian/' . $nama_foto, 40);

		// $file_foto->move(WRITEPATH . 'img/laporan/kejadian');

		$query = $this->FotoLaporanModel->save([
			'id_laporan' => $id_laporan,
			'foto' => $nama_foto,
			'deskripsi' => $deskripsi,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'upload_by' => 'pelapor',
			'id_user_upload' => $this->user_id_pelapor
		]);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Foto berhasil ditambah !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Foto gagal ditambah !'
			));
		}
	}

	public function ubah_deskripsi_foto_laporan()
	{
		$id_foto = $this->request->getPost('id_foto');
		$id_laporan = $this->request->getPost('id_laporan');
		$deskripsi = $this->request->getPost('deskripsi');

		$query = $this->FotoLaporanModel->updateFotoLaporan([
			'deskripsi' => $deskripsi
		], $id_foto);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Data foto berhasil diperbaharui !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Gagal memperbaharui data foto !'
			));
		}
	}

	public function hapus_foto_laporan()
	{
		$id_foto = $this->request->getPost('id_foto');
		$nama_file = $this->request->getPost('nama_file');

		unlink('img/laporan/kejadian/' . $nama_file);

		$query = $this->FotoLaporanModel->deleteFotoLaporan($id_foto);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Foto berhasil dihapus !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Foto gagal dihapus !'
			));
		}
	}

	public function tambah_laporan_korban()
	{
		$id_laporan = $this->request->getPost('id_laporan');
		$id_kategori_korban = $this->request->getPost('id_kategori_korban');
		$jumlah_korban = $this->request->getPost('jumlah_korban');
		$deskripsi = $this->request->getPost('deskripsi');

		$query = $this->LaporanKorbanModel->save([
			'id_laporan' => $id_laporan,
			'id_kategori_korban' => $id_kategori_korban,
			'jumlah_korban' => $jumlah_korban,
			'deskripsi' => $deskripsi,
			'input_by' => 'pelapor',
			'id_user_input' => $this->user_id_pelapor,
		]);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Berhasil menambahkan Laporan korban !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Gagal menambahkan laporan korban !'
			));
		}
	}

	public function ubah_laporan_korban()
	{
		$id_laporan_korban = $this->request->getPost('id_laporan_korban');
		$id_kategori_korban = $this->request->getPost('id_kategori_korban');
		$jumlah_korban = $this->request->getPost('jumlah_korban');
		$deskripsi = $this->request->getPost('deskripsi');

		$query = $this->LaporanKorbanModel->updateLaporanKorban([
			'id_kategori_korban' => $id_kategori_korban,
			'jumlah_korban' => $jumlah_korban,
			'deskripsi' => $deskripsi
		], $id_laporan_korban);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Berhasil mengubah laporan korban !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Gagal mengubah laporan korban !'
			));
		}
	}

	public function hapus_laporan_korban()
	{
		$id_laporan_korban = $this->request->getPost('id_laporan_korban');

		$query = $this->LaporanKorbanModel->deleteLaporanKorban($id_laporan_korban);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Berhasil menghapus data laporan korban !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Gagal menghapus data laporan korban !'
			));
		}
	}
}
