<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriKorbanModel extends Model
{
	protected $primaryKey = 'id_kategori_korban';
	protected $table = 'tb_kategori_korban';
	protected $allowedFields = [
		'id_kategori_korban',
		'kategori_korban',
		'deskripsi',
		'create_datetime',
		'update_datetime',
		'aktif'
	];

	public function getKategoriKorban($id_kategori_korban = false)
	{
		if ($id_kategori_korban == false) {
			return $this->orderBy('id_kategori_korban', 'desc')->findAll();
		}
		return $this->where(['id_kategori_korban' => $id_kategori_korban])->first();
	}

	public function getKategoriKorbanAktif()
	{
		return $this->where(['aktif' => 'Y'])->orderBy('id_kategori_korban', 'desc')->findAll();
	}

	public function updateKategoriKorban($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_kategori_korban' => $id));
		return $query;
	}

	public function deleteKategoriKorban($id)
	{
		return $this->db->table($this->table)->delete(['id_kategori_korban' => $id]);
	}
}
