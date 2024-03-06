<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Collier;
use App\Http\Resources\NecklaceResource;

class NecklaceController extends Controller
{
    public function getAllNecklaces()
    {
        return NecklaceResource::collection(Collier::all());
    }

    public function addNecklace(Request $request)
    {
        try {
            $necklace = new Collier([
                'id' => $request->input('id'),
                'idCollier' => $request->input('idCollier'),
                'position' => $request->input('position'),
            ]);
    
            $necklace->save();
    
            return response()->json(['message' => 'Necklace added successfully', 'data' => $necklace], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add necklace: ' . $e->getMessage()], 500);
        }
    }
}
