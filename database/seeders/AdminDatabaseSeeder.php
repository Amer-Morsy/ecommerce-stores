<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name'  => 'Amer Morsy',
            'email'  => 'amer.morsy2015@gmail.com',
            'password'  => bcrypt('12345678'),
        ]);
    }
}
