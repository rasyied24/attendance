<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Pastikan data admin tidak duplikat berdasarkan email
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'), // Pastikan mengganti password ini dengan yang lebih aman
                'role' => 'admin', // Role Admin
                'status' => 1, // Status aktif
            ]
        );

        $this->command->info('Admin has been created!');
    }
}
