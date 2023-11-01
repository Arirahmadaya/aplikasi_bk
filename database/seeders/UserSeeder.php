<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'nama' => 'Operator',
                'email' => 'operator@gmail.com',
                'role' => 'operator',
                'password' =>bcrypt('123456')
            ],

            [
                'nama' => 'Guru BK',
                'email' => 'guru_bk@gmail.com',
                'role' => 'guru_bk',
                'password' =>bcrypt('123456')
            ],

            [
                'nama' => 'Wali Kelas',
                'email' => 'wali_kelas@gmail.com',
                'role' => 'wali_kelas',
                'password' =>bcrypt('123456')
            ],

            [
                'nama' => 'Siswa',
                'email' => 'siswa@gmail.com',
                'role' => 'siswa',
                'password' =>bcrypt('123456')
            ],
            
            ];

            foreach ($userData as $key => $val){
                User::create($val);
            }
    }
}
