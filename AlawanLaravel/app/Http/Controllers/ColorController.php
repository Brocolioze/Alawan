<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Models\Color;
use App\Http\Resources\ColorResource;

use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{

    //afficher les color
    public function getAllColors()
    {
        return ColorResource::collection(Color::all());
    }

    public function getColor($id)
    {
        $color = Color::findOrFail($id);
        return $color;
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
