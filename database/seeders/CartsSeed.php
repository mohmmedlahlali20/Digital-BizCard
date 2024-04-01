<?php

namespace Database\Seeders;

use App\Models\Cartes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Cartes::create([
            'titre' => 'Sample Carte 1',
            'nom_entreprise' => 'Sample Company 1',
        ]);

        Cartes::create([
            'titre' => 'Sample Carte 2',
            'nom_entreprise' => 'Sample Company 2',
        ]);
    }
}
