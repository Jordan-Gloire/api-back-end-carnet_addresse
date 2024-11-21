<?php

namespace App\Http\Controllers;

use App\Models\Carnet;
use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


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
        $address = Carnet::paginate(5);
        // Retourner une réponse JSON avec les données paginées
        return response()->json([
            'success' => true,
            'addresses' => $address
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|min:5|max:15',
            'numero' => 'required|min:9|max:9',
            'address' => 'required',
            'birthdate' => 'required',
            'status' => 'required',
        ]);

        $address = $request->user()->carnets()->create($validateData);
        // dd($address);
        // Envoi de la notification à l'utilisateur connecté
        // $user = Auth::user();
        // if ($user) {
        //     Notification::send($user, new InvoicePaid($address));
        // } else {
        //     // Gérer le cas où l'utilisateur n'est pas authentifié
        //     return response()->json(['error' => 'Utilisateur non authentifié'], 401);
        // }

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
