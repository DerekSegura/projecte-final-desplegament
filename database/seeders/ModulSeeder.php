<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modul;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modul::create([
            'nom' => "Desplegament d'aplicacions " ,
            'hores' => '128',
            'professor_id' => '2',
            'departament_id' => '1',
        ]);

        Modul::create([
            'nom' => "Disseny d'aplicacions " ,
            'hores' => '264',
            'professor_id' => '1',
            'departament_id' => '1',
        ]);

        Modul::create([
            'nom' => "Llenguatge de marques " ,
            'hores' => '124',
            'professor_id' => '3',
            'departament_id' => '2',
        ]);
    }
}
