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
use \App\Models\JenisTindakanPersonilModel;
use \App\Models\AdminModel;

class DataMaster extends BaseController
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
		$this->JenisTindakanPersonilModel = new JenisTindakanPersonilModel();
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

	public function kategori_korban()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Kategori Korban',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_email' => $this->user_email,
			'user_no_hp' => $this->user_no_hp,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'kategori_korban' => $this->KategoriKorbanModel->getKategoriKorbanAktif()
		];
		return view('administrator/data-master/kategori-korban/views', $data);
	}

	public function tambah_kategori_korban()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$kategori_korban = $this->request->getPost('kategori_korban');
		$deskripsi = $this->request->getPost('deskripsi');

		if ($kategori_korban == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom kategori korban tidak boleh kosong !'
			));
			return false;
		}

		if ($deskripsi == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom deskripsi tidak boleh kosong !'
			));
			return false;
		}

		$this->KategoriKorbanModel->save([
			'kategori_korban' => $kategori_korban,
			'deskripsi' => $deskripsi,
			'create_datetime' => $waktu_data
		]);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}

	public function ubah_kategori_korban()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$id_kategori_korban = $this->request->getPost('id_kategori_korban');
		$kategori_korban = $this->request->getPost('kategori_korban');
		$deskripsi = $this->request->getPost('deskripsi');

		if ($kategori_korban == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom kategori korban tidak boleh kosong !'
			));
			return false;
		}

		if ($deskripsi == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom deskripsi tidak boleh kosong !'
			));
			return false;
		}

		$this->KategoriKorbanModel->updateKategoriKorban([
			'kategori_korban' => $kategori_korban,
			'deskripsi' => $deskripsi,
			'update_datetime' => $waktu_data
		], $id_kategori_korban);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}

	public function hapus_kategori_korban()
	{
		$id_kategori_korban = $this->request->getPost('id_kategori_korban');

		$query = $this->KategoriKorbanModel->updateKategoriKorban([
			'aktif' => "N"
		], $id_kategori_korban);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Data berhasil dihapus !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Data gagal dihapus !'
			));
		}
	}
	// End Kategori Korban

	// Kategori Kecelakaan
	public function kategori_kecelakaan()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Kategori Kecelakaan',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_email' => $this->user_email,
			'user_no_hp' => $this->user_no_hp,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'kategori_kecelakaan' => $this->KategoriKecelakaanModel->getKategoriKecelakaanAktif()
		];
		return view('administrator/data-master/kategori-kecelakaan/views', $data);
	}

	public function tambah_kategori_kecelakaan()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$kategori_kecelakaan = $this->request->getPost('kategori_kecelakaan');
		$deskripsi = $this->request->getPost('deskripsi');

		if ($kategori_kecelakaan == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom kategori korban tidak boleh kosong !'
			));
			return false;
		}

		if ($deskripsi == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom deskripsi tidak boleh kosong !'
			));
			return false;
		}

		$this->KategoriKecelakaanModel->save([
			'kategori_kecelakaan' => $kategori_kecelakaan,
			'deskripsi' => $deskripsi,
			'create_datetime' => $waktu_data
		]);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}

	public function ubah_kategori_kecelakaan()
	{
		$waktu_data = date("Y-m-d H:i:s");

		$id_kategori_kecelakaan = $this->request->getPost('id_kategori_kecelakaan');
		$kategori_kecelakaan = $this->request->getPost('kategori_kecelakaan');
		$deskripsi = $this->request->getPost('deskripsi');

		if ($kategori_kecelakaan == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom kategori korban tidak boleh kosong !'
			));
			return false;
		}

		if ($deskripsi == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom deskripsi tidak boleh kosong !'
			));
			return false;
		}

		$this->KategoriKecelakaanModel->updateKategoriKecelakaan([
			'kategori_kecelakaan' => $kategori_kecelakaan,
			'deskripsi' => $deskripsi,
			'update_datetime' => $waktu_data
		], $id_kategori_kecelakaan);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}

	public function hapus_kategori_kecelakaan()
	{
		$id_kategori_kecelakaan = $this->request->getPost('id_kategori_kecelakaan');

		$query = $this->KategoriKecelakaanModel->updateKategoriKecelakaan([
			'aktif' => "N"
		], $id_kategori_kecelakaan);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Data berhasil dihapus !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Data gagal dihapus !'
			));
		}
	}
	// End Kategori Kecelakaan


	// Kategori Laporan
	public function kategori_laporan()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Kategori Laporan',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_email' => $this->user_email,
			'user_no_hp' => $this->user_no_hp,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'kategori_laporan' => $this->KategoriLaporanModel->getKategoriLaporan()
		];
		return view('administrator/data-master/kategori-laporan/views', $data);
	}

	public function ubah_kategori_laporan()
	{
		$waktu_data = date("Y-m-d H:i:s");

		$id_kategori_laporan = $this->request->getPost('id_kategori_laporan');
		$kategori_laporan = $this->request->getPost('kategori_laporan');
		$deskripsi = $this->request->getPost('deskripsi');

		if ($kategori_laporan == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom kategori korban tidak boleh kosong !'
			));
			return false;
		}

		if ($deskripsi == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom deskripsi tidak boleh kosong !'
			));
			return false;
		}

		$this->KategoriLaporanModel->updateKategoriLaporan([
			'kategori_laporan' => $kategori_laporan,
			'deskripsi' => $deskripsi,
			'update_datetime' => $waktu_data
		], $id_kategori_laporan);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}
	// End Kategori Laporan


	// Jenis tindakan personil
	public function jenis_tindakan_personil()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Jenis Tindakan Personil',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_email' => $this->user_email,
			'user_no_hp' => $this->user_no_hp,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'jenis_tindakan' => $this->JenisTindakanPersonilModel->getJenisTindakanPersonilAktif()
		];
		return view('administrator/data-master/jenis-tindakan-personil/views', $data);
	}

	public function tambah_jenis_tindakan()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$jenis_tindakan = $this->request->getPost('jenis_tindakan');

		if ($jenis_tindakan == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom jenis tindakan tidak boleh kosong !'
			));
			return false;
		}

		$this->JenisTindakanPersonilModel->save([
			'jenis_tindakan' => $jenis_tindakan,
			'create_datetime' => $waktu_data
		]);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}

	public function ubah_jenis_tindakan()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$id_jenis_tindakan = $this->request->getPost('id_jenis_tindakan');
		$jenis_tindakan = $this->request->getPost('jenis_tindakan');

		if ($jenis_tindakan == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom jenis tindakan tidak boleh kosong !'
			));
			return false;
		}

		$this->JenisTindakanPersonilModel->updateJenisTindakanPersonil([
			'jenis_tindakan' => $jenis_tindakan,
			'update_datetime' => $waktu_data
		], $id_jenis_tindakan);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}

	public function hapus_jenis_tindakan()
	{
		$id_jenis_tindakan = $this->request->getPost('id_jenis_tindakan');

		$query = $this->JenisTindakanPersonilModel->updateJenisTindakanPersonil([
			'aktif' => "N"
		], $id_jenis_tindakan);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Data berhasil dihapus !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Data gagal dihapus !'
			));
		}
	}
	// End Jenis tindakan personil


	// Satuan Kerja Personil
	public function satker_personil()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Satuan Kerja Personil',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_email' => $this->user_email,
			'user_no_hp' => $this->user_no_hp,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'satker_personil' => $this->SatkerPersonilModel->getSatkerPersonilAktif()
		];
		return view('administrator/data-master/satker-personil/views', $data);
	}

	public function tambah_satker_personil()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$nama_satker = $this->request->getPost('nama_satker');

		if ($nama_satker == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom nama satuan kerja tidak boleh kosong !'
			));
			return false;
		}

		$this->SatkerPersonilModel->save([
			'nama_satker' => $nama_satker,
			'create_datetime' => $waktu_data
		]);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}

	public function ubah_satker_personil()
	{
		$waktu_data = date("Y-m-d H:i:s");

		$id_satker = $this->request->getPost('id_satker');
		$nama_satker = $this->request->getPost('nama_satker');

		if ($nama_satker == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom nama satuan kerja tidak boleh kosong !'
			));
			return false;
		}

		$this->SatkerPersonilModel->updateSatkerPersonil([
			'nama_satker' => $nama_satker,
			'update_datetime' => $waktu_data
		], $id_satker);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}

	public function hapus_satker_personil()
	{
		$id_satker = $this->request->getPost('id_satker');

		$query = $this->SatkerPersonilModel->updateSatkerPersonil([
			'aktif' => "N"
		], $id_satker);

		if ($query) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Data berhasil dihapus !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Data gagal dihapus !'
			));
		}
	}
	// End Satuan Kerja Personil


	// Pangkat Personil
	public function pangkat_personil()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Pangkat Personil',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_email' => $this->user_email,
			'user_no_hp' => $this->user_no_hp,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'pangkat_personil' => $this->PangkatPersonilModel->getPangkatPersonilAktif()
		];
		return view('administrator/data-master/pangkat-personil/views', $data);
	}

	public function ubah_pangkat_personil()
	{
		$waktu_data = date("Y-m-d H:i:s");
		$id_pangkat = $this->request->getPost('id_pangkat');
		$pangkat = $this->request->getPost('pangkat');
		$singkatan = $this->request->getPost('singkatan');

		if ($pangkat == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom pangkat tidak boleh kosong !'
			));
			return false;
		}

		if ($singkatan == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom singkatan tidak boleh kosong !'
			));
			return false;
		}

		$this->PangkatPersonilModel->updatePangkatPersonil([
			'pangkat' => $pangkat,
			'singkatan' => $singkatan,
			'update_datetime' => $waktu_data
		], $id_pangkat);

		echo json_encode(array(
			'success' => '1',
			'pesan' => 'Data berhasil disimpan !'
		));
	}
	// End Pangkat Personil
}
