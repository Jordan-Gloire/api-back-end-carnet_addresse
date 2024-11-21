<?php

namespace App\Http\Controllers;

use App\Models\Carnet;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CarnetController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [new Middleware('auth:sanctum', except: ['index', 'show'])];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'succes' => true,
            'addresse' => Carnet::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nom' => 'required|min:5|max:15',
            'numero' => 'required|min:9|max:9',
            'address' => 'required',
            'birthdate' => 'required',
            'status' => 'required',
        ]);

        $address = $request->user()->carnets()->create($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Adresse ajoutée avec succès',
            'addresse' => $address,

        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Carnet $carnet)
    {
        return response()->json([
            'addresse' => $carnet
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carnet $carnet)
    {
        $validateData = $request->validate([
            'nom' => 'required|min:5|max:15',
            'numero' => 'required|min:9|max:9',
            'address' => 'required',
            'birthdate' => 'required',
            'status' => 'required',
        ]);

        $carnet->update($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Adresse modifiée avec succès',
            'addresse' => $carnet,

        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carnet $carnet)
    {
        $carnet->delete();
        return response()->json([
            'success' => true,
            'message' => 'Adresse supprimée avec succès',

        ], 201);
    }
}