<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alumne;

class AlumneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a1 = Alumne::create([
            'nom' => 'Derek',
            'cognoms' => 'Segura',
            'dni' => '84532884D',
            'data_naixement' => '2006-01-14',
            'telefon' => '684160440',
            'grup' => 2,
        ]);

        $a1->moduls()->attach([
            1 => ['nota' => 7.5],
            2 => ['nota' => 8.0],
        ]);

        $a2 = Alumne::create([
            'nom' => 'Iker',
            'cognoms' => 'Carretero',
            'dni' => '32157712I',
            'data_naixement' => '2006-06-03',
            'telefon' => '684160230',
            'grup' => 1,
        ]);

        $a2->moduls()->attach([
            2 => ['nota' => 7.5],
            3 => ['nota' => 8.0],
        ]);
    }
}
