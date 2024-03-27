<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Models\AnimalColor;
use App\Http\Resources\AnimalColorResource;

use Illuminate\Support\Facades\Log;

class AnimalColorController extends Controller
{
    public function getAllAnimalColor()
    {
        return AnimalColorResource::collection(AnimalColor::all());
    }

    public function getAnimalColor($idAnimal)
    {
        $animalColor = AnimalColor::findOrFail($idAnimal);
        return $animalColor;
    }

    public function addAnimalColor(Request $request)
    {
        try {
            $animalColor = new AnimalColor([
                'idAnimal' => $request->input('idAnimal'),
                'idColor' => $request->input('idColor')
            ]);
    
            $animalColor->save();
    
            return response()->json(true);
        }
        catch (QueryException $e) {
            log::debug("Ca chier");
            return response()->json(false);
        }
    }

    public function deleteAnimalColor($id)
    {
        try {
            $animalColor = AnimalColor::findOrFail($id);
            $animalColor->delete();

            return response()->json(['message' => 'AnimalColor deleted successfully'], 200);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete AnimalColor: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'AnimalColor not found'], 404);
        }
    }
}
