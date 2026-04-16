<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sarpras.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'nis' => null,
            'kelas' => null,
        ]);

        User::create([
            'name' => 'Ahmad',
            'email' => 'ahmad1@sarpras.sch.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'nis' => '1001',
            'kelas' => '12 TJKT 1',
        ]);

        User::create([
            'name' => 'Zubika',
            'email' => 'zubika2@sarpras.sch.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'nis' => '1002',
            'kelas' => '12 PPLG 1',
        ]);

        // SISWA 3
        User::create([
            'name' => 'Noval',
            'email' => 'noval@sarpras.sch.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'nis' => '1003',
            'kelas' => '12 AKL',
        ]);
    }
}