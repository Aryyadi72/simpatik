<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['kode_barang', 'jumlah', 'tanggal_keluar', 'inputer', 'pemohon'];

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

    public function getBarangKeluar()
    {
        $builder = $this->db->table('barang_keluar');
        $builder->select('barang_keluar.*, barang.*, users.*');
        $builder->join('barang', 'barang_keluar.kode_barang = barang.kode_barang', 'left');
        $builder->join('users', 'barang_keluar.pemohon = users.id', 'left');
        $builder->orderBy('barang_keluar.id', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function getBarangKeluarByMonth($month)
    {
        $builder = $this->db->table('barang_keluar');
        $builder->select('barang_keluar.*, barang.*, users.*');
        $builder->join('barang', 'barang_keluar.kode_barang = barang.kode_barang', 'left');
        $builder->join('users', 'barang_keluar.pemohon = users.id', 'left');
        
        if ($month !== null) {
            $builder->where('MONTH(barang_keluar.tanggal_keluar)', $month);
        }
        
        $builder->orderBy('barang_keluar.id', 'DESC');
        return $builder->get()->getResultArray();
    }
}
