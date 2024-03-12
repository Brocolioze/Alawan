<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Models\Necklace;
use App\Http\Resources\NecklaceResource;

class NecklaceController extends Controller
{

    public function getAllNecklaces()
    {
        $necklaces = Necklace::all();

        return response()->json(['message' => 'Necklaces found', 'data' => $necklaces], 200);
    }


    public function addNecklace(Request $request)
    {
        try {
            $necklace = new Necklace([
                'idCollier' => $request->input('idCollier'),
                'position' => $request->input('position'),
            ]);

            $necklace->save();

            return response()->json(['message' => 'Necklace added successfully', 'data' => $necklace], 201);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add necklace: ' . $e->getMessage()], 500);
        }
    }


    public function deleteNecklace($id)
    {
        try {
            $necklace = Necklace::findOrFail($id);
            $necklace->delete();

            return response()->json(['message' => 'Necklace deleted successfully'], 200);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete necklace: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Necklace not found'], 404);
        }
    }
}
