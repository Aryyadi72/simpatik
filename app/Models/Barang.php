<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['kode_barang', 'nama_barang', 'jenis_barang', 'stok_barang', 'foto_barang'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // Function untuk mengecek kode barang terakhir yang ada di dalam database
    public function getLatestKodeBarang()
    {
        $latestKodeBarang = $this->db->table('barang')->select('kode_barang')->orderBy('created_at', 'desc')->limit(1)->get()->getRow();

        return $latestKodeBarang ? $latestKodeBarang->kode_barang : 'ATK00';
    }
}
