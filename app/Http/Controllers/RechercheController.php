<?php

namespace App\Http\Controllers;

use App\Models\Carnet;
use Illuminate\Http\Request;

class RechercheController extends Controller
{
    public function recherche(Request $request)
    {
        $query = Carnet::query();
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        return $query->get();
    }
}