<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        $data = [
            [
                'name'      => 'Administrator',
                'username'  => 'administrator',
                'email'     => 'admin@admin.com',
                'password'  => Hash::make('password'),
            ],
            [
                'name'      => 'Tono',
                'username'  => 'tonotono',
                'email'     => 'tono@admin.com',
                'password'  => Hash::make('password'),
            ],
        ];

        for ($i = 0; $i < count($data); $i++) {
            User::create($data[$i]);
        }
    }
}
