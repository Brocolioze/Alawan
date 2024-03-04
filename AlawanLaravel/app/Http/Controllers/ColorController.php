<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Address;
use App\Models\Alert;
use App\Models\AnimalColor;
use App\Models\Collier;
use App\Models\Color;
use App\Models\Person;
use App\Models\Race;

class ColorController extends Controller
{

    //afficher les color
    public function getAllColors()
    {
        $colors = Color::all();

        return response()->json(['message' => 'Colors found', 'data' => $colors], 200);
    }

    //ajouter color
    public function addColor(Request $request)
    {
        try {
            $color = new Color([
                'color' => $request->input('color')
            ]);

            $color->save();

            return response()->json(['message' => 'Color added successfully', 'data' => $color], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add color: ' . $e->getMessage()], 500);
        }
    }

    //supp color
    public function deleteColor($id)
    {
        try {
            $color = Color::findOrFail($id);
            $color->delete();

            return response()->json(['message' => 'Color deleted successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete color: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Color not found'], 404);
        }
    }
}
