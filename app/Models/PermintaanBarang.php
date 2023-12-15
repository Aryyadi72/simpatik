<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanBarang extends Model
{
    protected $table = 'permintaan_barang';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['kode_permintaan', 'kode_barang', 'jumlah', 'tanggal_permintaan', 'pemohon', 'status', 'keterangan'];

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

    // Function untuk mengecek kode permintaan terakhir yang ada di dalam database
    public function getLatestKodePermintaan()
    {
        $latestKodePermintaan = $this->db->table('permintaan_barang')->select('kode_permintaan')->orderBy('created_at', 'desc')->limit(1)->get()->getRow();

        return $latestKodePermintaan ? $latestKodePermintaan->kode_permintaan : 'KP00';
    }

    public function findByKodePermintaan($kode_permintaan)
    {
        return $this->where('kode_permintaan', $kode_permintaan)->findAll();
    }

}
