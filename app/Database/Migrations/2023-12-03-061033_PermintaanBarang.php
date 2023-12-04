<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PermintaanBarang extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel barang
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'kode_permintaan' => [
				'type'          => 'VARCHAR',
				'constraint'    => 255,
			],
            'kode_barang' => [
				'type'          => 'VARCHAR',
				'constraint'    => 255,
			],
			'jumlah' => [
				'type'          => 'INT',
				'constraint'    => 11,
			],
			'tanggal_permintaan' => [
				'type'          => 'DATE',
			],
            'pemohon' => [
				'type'          => 'INT',
                'constraint'    => 11,
			],
            'status' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
            'keterangan' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel permintaan_barang
		$this->forge->createTable('permintaan_barang', TRUE);
    }

    public function down()
    {
        // menghapus tabel permintaan_barang
		$this->forge->dropTable('permintaan_barang');
    }
}
