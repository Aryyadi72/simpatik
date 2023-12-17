<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['kode_barang', 'jumlah', 'tanggal_masuk', 'inputer'];

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

    // Function untuk menjoin atau menggabungkan data barang dan barang masuk
    public function getAllBarang()
    {
        $builder = $this->db->table('barang_masuk');
        $builder->select('barang_masuk.*, barang.*');
        $builder->join('barang', 'barang_masuk.kode_barang = barang.kode_barang', 'left');
        $builder->orderBy('barang_masuk.id', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function getBarangInputer()
    {
        $builder = $this->db->table('barang_masuk');
        $builder->select('barang_masuk.*, users.*');
        $builder->join('users', 'barang_masuk.inputer = users.id', 'left');
        return $builder->get()->getResultArray();
    }
}
