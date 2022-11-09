<?php

namespace App\Models;

use CodeIgniter\Model;

class PangkatPersonilModel extends Model
{
	protected $primaryKey = 'id_pangkat';
	protected $table = 'tb_pangkat_personil';
	protected $allowedFields = [
		'id_pangkat',
		'pangkat',
		'singkatan',
		'create_datetime',
		'update_datetime',
		'aktif'
	];

	public function getPangkatPersonil($id_pangkat = false)
	{
		if ($id_pangkat == false) {
			return $this->orderBy('id_pangkat', 'desc')->findAll();
		}
		return $this->where(['id_pangkat' => $id_pangkat])->first();
	}

	public function getPangkatPersonilAktif()
	{
		return $this->where(['aktif' => 'Y'])->orderBy('id_pangkat', 'asc')->findAll();
	}

	public function updatePangkatPersonil($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_pangkat' => $id));
		return $query;
	}

	public function deletePangkatPersonil($id)
	{
		return $this->db->table($this->table)->delete(['id_pangkat' => $id]);
	}
}
