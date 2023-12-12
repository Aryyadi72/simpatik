<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nik' => '1234567',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'nama' => 'Admin User',
                'no_hp' => '08123456789',
                'level' => 'admin',
            ],
            [
                'nik' => '89101112',
                'username' => 'guru1',
                'email' => 'guru1@example.com',
                'password' => password_hash('guru123', PASSWORD_BCRYPT),
                'nama' => 'Guru 1',
                'no_hp' => '08123456790',
                'level' => 'guru',
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
