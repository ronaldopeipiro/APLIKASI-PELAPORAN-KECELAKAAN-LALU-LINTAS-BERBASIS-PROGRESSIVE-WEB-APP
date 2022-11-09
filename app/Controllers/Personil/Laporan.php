<?php

namespace App\Controllers\Personil;

use App\Controllers\BaseController;
use \App\Models\PersonilModel;
use \App\Models\PelaporModel;
use \App\Models\PangkatPersonilModel;
use \App\Models\SatkerPersonilModel;
use \App\Models\LaporanModel;
use \App\Models\FotoLaporanModel;
use \App\Models\KategoriLaporanModel;
use \App\Models\KategoriKorbanModel;
use \App\Models\KategoriKecelakaanModel;
use \App\Models\JenisTindakanPersonilModel;
use \App\Models\TindakanPersonilModel;
use \App\Models\FotoTindakanPersonilModel;

class Laporan extends BaseController
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
		$this->JenisTindakanPersonilModel = new JenisTindakanPersonilModel();
		$this->TindakanPersonilModel = new TindakanPersonilModel();
		$this->FotoTindakanPersonilModel = new FotoTindakanPersonilModel();

		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();

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
			'title' => 'Laporan',
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
			'user_status_aktif' => $this->user_status_aktif,
			'laporan' => $this->LaporanModel->getLaporan()
		];
		return view('personil/laporan/views', $data);
	}

	public function detail($token)
	{
		$data_laporan = $this->LaporanModel->getLaporanByToken($token);

		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Detail Laporan',
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
			'user_status_aktif' => $this->user_status_aktif,
			'laporan' => $data_laporan
		];
		return view('personil/laporan/detail', $data);
	}

	public function history()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'History Tindakan',
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
			'user_status_aktif' => $this->user_status_aktif,
			'laporan' => $this->LaporanModel->getLaporanByIdPelapor($this->id_user)
		];
		return view('personil/history/views', $data);
	}

	public function getLaporanMasuk()
	{
		$jenis_data = $this->request->getPost('jenis_data');
		$user_latitude = $this->request->getPost('user_latitude');
		$user_longitude = $this->request->getPost('user_longitude');

		$index = 0;
		$data = [];

		if ($jenis_data == "today") {
			$date_today = date('Y-m-d');
			$data_laporan = $this->db->query("SELECT * FROM tb_laporan WHERE DATE(waktu) = '$date_today' ORDER BY id_laporan DESC ");
		} elseif ($jenis_data == "periodic") {
			$start_date = $this->request->getPost('start_date');
			$end_date = $this->request->getPost('end_date');
			$data_laporan = $this->db->query("SELECT * FROM tb_laporan WHERE waktu BETWEEN '$start_date' AND '$end_date' ORDER BY id_laporan DESC ");
		} elseif ((!isset($jenis_data)) or ($jenis_data == "")) {
			$data_laporan = $this->db->query("SELECT * FROM tb_laporan ORDER BY id_laporan DESC ");
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

			$hitung_jarak = $ClassHome->distance_matrix_google($user_latitude, $user_longitude, $row['latitude'], $row['longitude']);
			$jarak = $hitung_jarak['distance'];
			$data_waktu_tempuh = explode(' ', $hitung_jarak['duration']);
			$waktu_tempuh = $data_waktu_tempuh[0] . " menit";

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
			$data[$index]['jarak'] = $jarak;
			$data[$index]['waktu_tempuh'] = $waktu_tempuh;
			$data[$index]['deskripsi'] = $row['deskripsi'];
			$data[$index]['status'] = $row['status'];
			$data[$index]['status_text'] = $status_text;
			$data[$index]['verifikasi'] = $row['verifikasi'];
			$data[$index]['verifikasi_text'] = $verifikasi_text;
			$index++;
		}
		echo json_encode($data);
	}

	public function getHistoryTindakan()
	{
		$jenis_data = $this->request->getPost('jenis_data');

		$index = 0;
		$data = [];

		if ($jenis_data == "today") {
			$date_today = date('Y-m-d');

			$data_laporan = $this->db->query("SELECT * FROM tb_laporan WHERE id_laporan IN (SELECT id_laporan FROM tb_tindakan_personil WHERE id_personil = '$this->id_user') AND DATE(waktu) = '$date_today' ORDER BY id_laporan DESC ");
		} elseif ($jenis_data == "periodic") {
			$start_date = $this->request->getPost('start_date');
			$end_date = $this->request->getPost('end_date');

			$data_laporan = $this->db->query("SELECT * FROM tb_laporan WHERE id_laporan IN (SELECT id_laporan FROM tb_tindakan_personil WHERE id_personil = '$this->id_user') AND waktu BETWEEN '$start_date' AND '$end_date' ORDER BY id_laporan DESC ");
		} elseif ($jenis_data == "all") {
		}
		$data_laporan = $this->db->query("SELECT * FROM tb_laporan WHERE id_laporan IN (SELECT id_laporan FROM tb_tindakan_personil WHERE id_personil = '$this->id_user') ORDER BY id_laporan DESC ");

		foreach ($data_laporan->getResult('array') as $row) {
			$id_laporan = $row['id_laporan'];
			$jumlah_personil_tindak_lanjut = $this->db->query("SELECT DISTINCT id_personil FROM tb_tindakan_personil WHERE id_laporan='$id_laporan' ")->getNumRows();

			if ($jumlah_personil_tindak_lanjut > 1) {
				$text_jumlah_personil_tindak_lanjut = "Ditindaklanjuti oleh anda dan " . ($jumlah_personil_tindak_lanjut - 1) . " personel lainnya";
			} else {
				$text_jumlah_personil_tindak_lanjut = "Ditindaklanjuti oleh anda";
			}

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
			$data[$index]['jumlah_personil_tindak_lanjut'] = $jumlah_personil_tindak_lanjut;
			$data[$index]['text_jumlah_personil_tindak_lanjut'] = $text_jumlah_personil_tindak_lanjut;
			$index++;
		}
		echo json_encode($data);
	}


	public function tambah_foto_tindakan()
	{
		$file_foto = $this->request->getFile('foto');
		$id_tindakan = $this->request->getPost('id_tindakan');
		$deskripsi = $this->request->getPost('deskripsi');
		$latitude = $this->request->getPost('latitude');
		$longitude = $this->request->getPost('longitude');

		$nama_foto = $file_foto->getRandomName();

		// Image manipulation
		$image = \Config\Services::image()
			->withFile($file_foto)
			->withResource()
			->save('img/laporan/tindakan/' . $nama_foto, 60);

		// $file_foto->move(WRITEPATH . 'img/laporan/kejadian');

		$query = $this->FotoTindakanPersonilModel->save([
			'id_tindakan' => $id_tindakan,
			'foto' => $nama_foto,
			'deskripsi' => $deskripsi,
			'latitude' => $latitude,
			'longitude' => $longitude,
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

	public function ubah_deskripsi_foto_tindakan()
	{
		$id_foto = $this->request->getPost('id_foto');
		$deskripsi = $this->request->getPost('deskripsi');

		$query = $this->FotoTindakanPersonilModel->updateFotoTindakanPersonil([
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

	public function hapus_foto_tindakan()
	{
		$id_foto = $this->request->getPost('id_foto');
		$nama_file = $this->request->getPost('nama_file');

		unlink('img/laporan/tindakan/' . $nama_file);

		$query = $this->FotoTindakanPersonilModel->deleteFotoTindakanPersonil($id_foto);

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

	public function tambah_tindakan()
	{
		$id_jenis_tindakan = $this->request->getPost('id_jenis_tindakan');
		$id_laporan = $this->request->getPost('id_laporan');
		$latitude = $this->request->getPost('latitude');
		$longitude = $this->request->getPost('longitude');

		$this->db->query("UPDATE tb_laporan SET status = '1' ");

		$query = $this->TindakanPersonilModel->save([
			'id_jenis_tindakan' => $id_jenis_tindakan,
			'id_laporan' => $id_laporan,
			'id_personil' => $this->id_user,
			'latitude' => $latitude,
			'longitude' => $longitude
		]);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Tindakan berhasil ditambah !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Gagal menambah tindakan !'
			));
		}
	}

	public function batalkan_tindakan()
	{
		$id_tindakan = $this->request->getPost('id_tindakan');
		$id_jenis_tindakan = $this->request->getPost('id_jenis_tindakan');
		$id_laporan = $this->request->getPost('id_laporan');

		if ($id_jenis_tindakan == "1") {
			// Update status laporan jadi menunggu respon
			$this->db->query("UPDATE tb_laporan SET status = '0' ");

			// Hapus semua foto tindakan
			$data_foto_tindakan = $this->db->query("SELECT * FROM tb_foto_tindakan_personil WHERE id_tindakan IN (SELECT id_tindakan FROM tb_tindakan_personil WHERE id_laporan = '$id_laporan') ");
			foreach ($data_foto_tindakan->getResult('array') as $row) {
				$id_foto = $row['id_foto'];
				$foto = $row['foto'];
				unlink('img/laporan/tindakan/' . $foto);

				$this->db->query("DELETE FROM tb_foto_tindakan_personil WHERE id_foto='$id_foto' ");
			}

			// Hapus semua tindakan
			$query = $this->db->query("DELETE FROM tb_tindakan_personil WHERE id_laporan = '$id_laporan' ");
		} else {

			// Hapus foto tindakan terkait
			$data_foto_tindakan = $this->db->query("SELECT * FROM tb_foto_tindakan_personil WHERE id_tindakan = '$id_tindakan' ");
			foreach ($data_foto_tindakan->getResult('array') as $row) {
				$id_foto = $row['id_foto'];
				$foto = $row['foto'];
				unlink('img/laporan/tindakan/' . $foto);

				$this->db->query("DELETE FROM tb_foto_tindakan_personil WHERE id_foto='$id_foto' ");
			}

			// Hapus tindakan terkait
			$query = $this->db->query("DELETE FROM tb_tindakan_personil WHERE id_tindakan = '$id_tindakan' ");
		}

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Tindakan dibatalkan !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Gagal membatalkan tindakan !'
			));
		}
	}

	public function verifikasi_laporan()
	{
		$id_laporan = $this->request->getPost('id_laporan');
		$verifikasi = $this->request->getPost('verifikasi');

		$query = $this->db->query("UPDATE tb_laporan SET verifikasi = '$verifikasi' WHERE id_laporan = '$id_laporan' ");

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Berhasil melakukan verifikasi laporan'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Gagal melakukan verifikasi laporan, terjadi kesalahan teknis !'
			));
		}
	}
}
