<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel users
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nik' => [
				'type'          => 'VARCHAR',
				'constraint'    => 255,
			],
			'nama' => [
				'type'          => 'VARCHAR',
				'constraint'    => 255,
			],
			'no_hp' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
			'email' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
            'username' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
            'password' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
            'level' => [
				'type'          => 'VARCHAR',
                'constraint'    => 255,
			],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel users
		$this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        // menghapus tabel users
		$this->forge->dropTable('users');
    }
}
