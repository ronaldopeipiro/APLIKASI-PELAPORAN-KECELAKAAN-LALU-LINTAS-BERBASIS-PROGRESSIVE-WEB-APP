<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoLaporanModel extends Model
{
	protected $primaryKey = 'id_foto';
	protected $table = 'tb_foto_laporan';
	protected $allowedFields = [
		'id_foto',
		'id_laporan',
		'foto',
		'deskripsi',
		'latitude',
		'longitude',
		'upload_by',
		'id_user_upload',
		'update_datetime',
		'create_datetime'
	];

	public function getFotoLaporan($id_foto = false)
	{
		if ($id_foto == false) {
			return $this->orderBy('id_foto', 'desc')->findAll();
		}
		return $this->where(['id_foto' => $id_foto])->first();
	}

	public function getFotoLaporanByIdLaporan($id_laporan)
	{
		return $this->where([
			'id_laporan' => $id_laporan
		])->orderBy('id_foto', 'desc')->findAll();
	}

	public function updateFotoLaporan($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_foto' => $id));
		return $query;
	}

	public function deleteFotoLaporan($id)
	{
		return $this->db->table($this->table)->delete(['id_foto' => $id]);
	}
}
