<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cartes;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartsTest extends TestCase
{

    //use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_Store_With_Authenticated_User()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $response = $this->postJson('/api/cartes', [
            'titre' => 'Test Carte',
            'nom_entreprise' => 'Test Company'
        ]);
    
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => true,
                     'message' => 'cartes created successfully',
                     'carts' => [
                         'titre' => 'Test Carte',
                         'nom_entreprise' => 'Test Company',
                         'user_id' => $user->id
                     ]
                 ]);
    
        $this->assertDatabaseHas('cartes', [
            'titre' => 'Test Carte',
            'nom_entreprise' => 'Test Company',
            'user_id' => $user->id
        ]);
    }

    public function test_Update_Carte_With_Authenticated_User()
    {
        // Créer un utilisateur
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $carte = Cartes::factory()->create(['user_id' => $user->id]);
    
        $response = $this->patchJson('/api/cartes/' . $carte->id, [
            'titre' => 'Updated Title',
            'nom_entreprise' => 'Updated Company Name'
        ]);
    
        $response->assertStatus(200)
        ->assertJson([
            'status' => true,
            'message' => 'Cartes updated successfully',
            'carts' => [
                'id' => $carte->id,
                'titre' => 'Updated Title',
                'nom_entreprise' => 'Updated Company Name',
                'user_id' => $user->id
            ]
        ]);
    

        $this->assertDatabaseHas('cartes', [
            'id' => $carte->id,
            'titre' => 'Updated Title',
            'nom_entreprise' => 'Updated Company Name',
            'user_id' => $user->id
        ]);
    }
    public function test_Delete_Carte_With_Authenticated_User()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    
        // Envoyer une requête de suppression avec l'ID statique 10
        $response = $this->deleteJson('/api/cartes/10');
    
        // Vérifier le statut de la réponse
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Cartes Deleted successfully'
                 ]);
    
        //$this->assertDatabaseMissing('cartes', ['id' => 10]);
    }
    

     
}
