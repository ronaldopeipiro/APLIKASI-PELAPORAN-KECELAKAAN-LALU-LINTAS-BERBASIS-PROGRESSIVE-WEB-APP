<?php

namespace App\Models;

use CodeIgniter\Model;

class TindakanPersonilModel extends Model
{
	protected $primaryKey = 'id_tindakan';
	protected $table = 'tb_tindakan_personil';
	protected $allowedFields = [
		'id_tindakan',
		'id_jenis_tindakan',
		'id_laporan',
		'id_personil',
		'latitude',
		'longitude',
		'waktu',
	];

	public function getTindakanPersonil($id_tindakan = false)
	{
		if ($id_tindakan == false) {
			return $this->orderBy('id_tindakan', 'desc')->findAll();
		}
		return $this->where(['id_tindakan' => $id_tindakan])->first();
	}

	public function updateTindakanPersonil($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_tindakan' => $id));
		return $query;
	}

	public function deleteTindakanPersonil($id)
	{
		return $this->db->table($this->table)->delete(['id_tindakan' => $id]);
	}
}
