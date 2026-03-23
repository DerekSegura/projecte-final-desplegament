<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Professor;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Professor::create([
            'nom' => 'David',
            'cognoms' => 'Martinez',
            'email' => 'david.martinez@iescarlesvallbona.cat',
        ]);

        Professor::create([
            'nom' => 'Romà',
            'cognoms' => 'Bejar',
            'email' => 'roma.bejar@iescarlesvallbona.cat',
        ]);

        Professor::create([
            'nom' => 'Oriol',
            'cognoms' => 'Rodriguez',
            'email' => 'oriol.rodriguezz@iescarlesvallbona.cat',
        ]);
    }
}
