<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departament;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departament::create([
            'nom' => 'Informatica',
            'descripcio' => 'Departament d informatica',
            'professor_id' => '1',
        ]);

        Departament::create([
            'nom' => 'Xarxes',
            'descripcio' => 'Departament de xarxes',
            'professor_id' => '2',
        ]);
    }
}
