<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['nom' => 'Roman', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Science-Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Biographie', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Développement personnel', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Histoire', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
