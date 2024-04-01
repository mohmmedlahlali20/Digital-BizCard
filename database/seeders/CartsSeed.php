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
            'titre' => 'MOHAMMED',
            'nom_entreprise' => 'youCOde',
            'user_id' => 2,
        ]);
    }
}
