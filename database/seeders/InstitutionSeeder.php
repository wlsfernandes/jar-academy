<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('institutions')->insert([
            [
                'name' => 'Amid Learning',
                'address' => '123 Main Street, City, Country',
                'phone' => '123-456-7890',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
