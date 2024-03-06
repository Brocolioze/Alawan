<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Http\Resources\AlertResource;

class AlertController extends Controller
{
    public function getAllAlerts()
    {
        return AlertResource::collection(Alert::all());
    }

    public function addAlert(Request $request)
    {
        try {
            $alert = new Alert([
                'id' => $request->input('id'),
                'idAnimal' => $request->input('idAnimal'),
                'dateLost' => $request->input('dateLost'),
                'dateFind' => $request->input('dateFind'),
                'place' => $request->input('place'),
                'description' => $request->input('description'),
                'alerteFound' => $request->input('alerteFound')
            ]);
    
            $alert->save();
    
            return response()->json(['message' => 'Alert added successfully', 'data' => $alert], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add alert: ' . $e->getMessage()], 500);
        }
    }
}
