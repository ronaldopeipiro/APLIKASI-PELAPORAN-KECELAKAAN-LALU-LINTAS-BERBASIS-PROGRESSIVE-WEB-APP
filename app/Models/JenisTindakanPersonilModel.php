<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisTindakanPersonilModel extends Model
{
	protected $primaryKey = 'id_jenis_tindakan';
	protected $table = 'tb_jenis_tindakan_personil';
	protected $allowedFields = [
		'id_jenis_tindakan',
		'jenis_tindakan',
		'create_datetime',
		'update_datetime',
		'aktif'
	];

	public function getJenisTindakanPersonil($id_jenis_tindakan = false)
	{
		if ($id_jenis_tindakan == false) {
			return $this->orderBy('id_jenis_tindakan', 'desc')->findAll();
		}
		return $this->where(['id_jenis_tindakan' => $id_jenis_tindakan])->first();
	}

	public function getJenisTindakanPersonilAktif()
	{
		return $this->where(['aktif' => 'Y'])->orderBy('id_jenis_tindakan', 'desc')->findAll();
	}


	public function updateJenisTindakanPersonil($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_jenis_tindakan' => $id));
		return $query;
	}

	public function deleteJenisTindakanPersonil($id)
	{
		return $this->db->table($this->table)->delete(['id_jenis_tindakan' => $id]);
	}
}
