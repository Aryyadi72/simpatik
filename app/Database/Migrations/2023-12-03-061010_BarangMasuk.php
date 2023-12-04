<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangMasuk extends Migration
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
			'kode_barang' => [
				'type'          => 'VARCHAR',
				'constraint'    => 255,
			],
			'jumlah' => [
				'type'          => 'INT',
				'constraint'    => 11,
			],
			'tanggal_masuk' => [
				'type'          => 'DATE',
			],
			'inputer' => [
				'type'          => 'INT',
                'constraint'    => 11,
			],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel barang_masuk
		$this->forge->createTable('barang_masuk', TRUE);
    }

    public function down()
    {
        // menghapus tabel barang_masuk
		$this->forge->dropTable('barang_masuk');
    }
}
