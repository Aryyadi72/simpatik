<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
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
			'nama_barang' => [
				'type'          => 'VARCHAR',
				'constraint'    => 255,
			],
			'jenis_barang' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
			'stok_barang' => [
				'type'          => 'INT',
                'constraint'    => 11,
			],
            'foto_barang' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel barang
		$this->forge->createTable('barang', TRUE);
    }

    public function down()
    {
        // menghapus tabel barang
		$this->forge->dropTable('barang');
    }
}
