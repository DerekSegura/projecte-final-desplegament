<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grup;

class GrupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grup::create([
            'nom' => '1DAW',
            'aula' => 'A23',
            'professor_id' => '2',
        ]);

        Grup::create([
            'nom' => '2DAW',
            'aula' => 'A27',
            'professor_id' => '1',
        ]);

        Grup::create([
            'nom' => '2DAWB',
            'aula' => 'A29',
            'professor_id' => '3',
        ]);
    }
}
