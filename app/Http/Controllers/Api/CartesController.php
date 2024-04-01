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
        ///home/mohammed/Desktop/Project Api/Digital-BizCard/app
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $user = Auth::user();
        if ($user) {
            $cartes = Cartes::create([
                'titre' => $request->titre,
                'nom_entreprise' => $request->nom_entreprise,
                'user_id' => $user->id
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'cartes created successfully',
                'carts' => $cartes
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please log in to create a business card.',
                'user' => $user
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cartes $cartes)
    {
      
            $cartes = Cartes::findOrFail($cartes->id);
            return response()->json([
                'status' => true,
                'carts' => $cartes
            ]);   
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
    public function update(Request $request, $id)
    {
        $user = Auth::user();
    
        if ($user) {
            $cartesToUpdate = Cartes::find($id);
    //dd($cartesToUpdate);
            if ($cartesToUpdate) {
                // Debugging: Check request data
                //dd($request->all());
                //dd($request->all());
                // Validate request data
                $validatedData = $request->validate([
                    'titre' => 'required|string', // Adjust validation rule if necessary
                    'nom_entreprise' => 'required|string', // Adjust validation rule if necessary
                ]);
    
                // Debugging: Check validated data
                //dd($validatedData);
    
                $cartesToUpdate->update([
                    'titre' => $validatedData['titre'],
                    'nom_entreprise' => $validatedData['nom_entreprise'],
                    'user_id' => $user->id
                ]);
    
                return response()->json([
                    'status' => true,
                    'message' => 'Cartes updated successfully',
                    'carts' => $cartesToUpdate
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized. Please log in to update a business card.',
                ], 401);
            }
        }
    }
    
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cartes $cartes)
    {
        $cartes->delete();
        return response()->json([
            'status' => true,
            'message' => 'Cartes Deleted successfully',
            
        ]);
    }
}
