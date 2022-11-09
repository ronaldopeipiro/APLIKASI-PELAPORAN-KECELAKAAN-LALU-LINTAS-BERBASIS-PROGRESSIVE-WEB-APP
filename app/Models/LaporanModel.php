<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
	protected $primaryKey = 'id_laporan';
	protected $table = 'tb_laporan';
	protected $allowedFields = [
		'id_laporan',
		'token',
		'waktu',
		'id_pelapor',
		'id_kategori_laporan',
		'id_kategori_kecelakaan',
		'latitude',
		'longitude',
		'deskripsi',
		'status',
		'verifikasi'
	];

	public function getLaporan($id_laporan = false)
	{
		if ($id_laporan == false) {
			return $this->orderBy('id_laporan', 'desc')->findAll();
		}
		return $this->where(['id_laporan' => $id_laporan])->first();
	}

	public function getDaerahRawan()
	{
		// return $this->where([
		// 	'verifikasi' => '1'
		// ])->orderBy('id_laporan', 'desc')->findAll();

		return $this->orderBy('id_laporan', 'desc')->findAll();
	}

	public function getLaporanToday()
	{
		$hari_ini = date("Y-m-d");
		return $this->where(['waktu' => $hari_ini])->orderBy('id_laporan', 'desc')->findAll();
	}

	public function getLaporanByIdPelapor($id_pelapor)
	{
		return $this->where([
			'id_pelapor' => $id_pelapor
		])->orderBy('id_laporan', 'desc')->findAll();
	}

	public function getLaporanByToken($token)
	{
		return $this->where([
			'token' => $token
		])->first();
	}

	public function getLaporanByIdPelaporToday($id_pelapor)
	{
		$hari_ini = date("Y-m-d");
		return $this->where([
			'id_pelapor' => $id_pelapor,
			'waktu' => $hari_ini
		])->orderBy('id_laporan', 'desc')->findAll();
	}

	public function getLaporanByIdKategoriLaporan($id_kategori_laporan)
	{
		return $this->where([
			'id_kategori_laporan' => $id_kategori_laporan
		])->orderBy('id_laporan', 'desc')->findAll();
	}

	public function getLaporanByIdKategoriKecelakaan($id_kategori_kecelakaan)
	{
		return $this->where([
			'id_kategori_kecelakaan' => $id_kategori_kecelakaan
		])->orderBy('id_laporan', 'desc')->findAll();
	}

	public function updateLaporan($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_laporan' => $id));
		return $query;
	}

	public function deleteLaporan($id)
	{
		return $this->db->table($this->table)->delete(['id_laporan' => $id]);
	}
}
