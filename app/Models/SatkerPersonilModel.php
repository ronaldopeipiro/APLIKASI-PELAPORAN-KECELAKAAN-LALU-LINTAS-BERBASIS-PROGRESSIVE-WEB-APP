<?php

namespace App\Models;

use CodeIgniter\Model;

class SatkerPersonilModel extends Model
{
	protected $primaryKey = 'id_satker';
	protected $table = 'tb_satker_personil';
	protected $allowedFields = [
		'id_satker',
		'nama_satker',
		'create_datetime',
		'update_datetime',
		'aktif'
	];

	public function getSatkerPersonil($id_satker = false)
	{
		if ($id_satker == false) {
			return $this->orderBy('id_satker', 'desc')->findAll();
		}
		return $this->where(['id_satker' => $id_satker])->first();
	}

	public function getSatkerPersonilAktif()
	{
		return $this->where(['aktif' => 'Y'])->orderBy('id_satker', 'desc')->findAll();
	}

	public function updateSatkerPersonil($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_satker' => $id));
		return $query;
	}

	public function deleteSatkerPersonil($id)
	{
		return $this->db->table($this->table)->delete(['id_satker' => $id]);
	}
}
