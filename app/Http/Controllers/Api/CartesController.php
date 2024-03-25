<?php

namespace App\Http\Controllers\Api;

use App\Models\Cartes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cartes::all();
        return response()->json([
            'status' => true ,
            'carts' => $carts
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = auth()->user();
      
        if (!$user) {
            $cartes = Cartes::create([
                'titre' => $request->titre,
                'nom_entreprise' => $request->nom_entreprise,
                
                
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'cartes created successfully',
                'carts' => $cartes
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please log in to create a business card.'
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cartes $cartes)
    {
        try {
            $carts = Cartes::findOrFail($cartes->id);
            return response()->json([
                'status' => true,
                'carts' => $carts
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Business card not found.'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cartes $cartes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cartes $cartes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cartes $cartes)
    {
        //
    }
}
