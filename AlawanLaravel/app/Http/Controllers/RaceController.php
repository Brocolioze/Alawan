<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Models\Race;
use App\Http\Resources\RaceResource;

class RaceController extends Controller
{

    public function getAllRaces()
    {
        $races = Race::all();

        return response()->json(['message' => 'Races found', 'data' => $races], 200);
    }


    public function addRace(Request $request)
    {
        try {
            $race = new Race([
                'race' => $request->input('race')
            ]);

            $race->save();

            return response()->json(['message' => 'Race added successfully', 'data' => $race], 201);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add race: ' . $e->getMessage()], 500);
        }
    }


    public function deleteRace($id)
    {
        try {
            $race = Race::findOrFail($id);
            $race->delete();

            return response()->json(['message' => 'Race deleted successfully'], 200);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete race: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Race not found'], 404);
        }
    }
}
