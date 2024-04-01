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

    public function test_Store_Without_Authenticated_User()
    {
   
        DB::table('cartes')->truncate();
    
        $response = $this->postJson('/api/cartes', [
            'titre' => 'Test Carte',
            'nom_entreprise' => 'Test Company'
        ]);
    
        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Unauthenticated.'
                 ]);
    
        $this->assertDatabaseMissing('cartes', [
            'titre' => 'Test Carte',
            'nom_entreprise' => 'Test Company'
        ]);
    }
    
    
    
}
