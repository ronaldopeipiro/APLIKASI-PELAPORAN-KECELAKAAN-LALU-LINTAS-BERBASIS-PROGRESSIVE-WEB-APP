<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoTindakanPersonilModel extends Model
{
	protected $primaryKey = 'id_foto';
	protected $table = 'tb_foto_tindakan_personil';
	protected $allowedFields = [
		'id_foto',
		'id_tindakan',
		'foto',
		'deskripsi',
		'latitude',
		'longitude',
		'update_datetime',
		'create_datetime'
	];

	public function getFotoTindakanPersonil($id_foto = false)
	{
		if ($id_foto == false) {
			return $this->orderBy('id_foto', 'desc')->findAll();
		}
		return $this->where(['id_foto' => $id_foto])->first();
	}

	public function getFotoTindakanPersonilByIdTindakan($id_tindakan)
	{
		return $this->where([
			'id_tindakan' => $id_tindakan
		])->orderBy('id_foto', 'desc')->findAll();
	}

	public function updateFotoTindakanPersonil($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_foto' => $id));
		return $query;
	}

	public function deleteFotoTindakanPersonil($id)
	{
		return $this->db->table($this->table)->delete(['id_foto' => $id]);
	}
}
