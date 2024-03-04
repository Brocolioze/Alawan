<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Address;
use App\Models\Alert;
use App\Models\AnimalColor;
use App\Models\Collier;
use App\Models\Color;
use App\Models\Person;
use App\Models\Race;
use App\Http\Resources\AnimalRessource;




class AnimalController extends Controller
{

    //afficher les animaux admin 
            public function getAllAnimals()
        {
            //$animals = Animal::all();
            //return response()->json(['message' => 'Animals found', 'data' => $animals], 200);
            return AnimalResource::collection(Animal::all());
        }

    //afficher les animaux de la personne 
            public function getAnimalsOfLoggedInPerson()
        {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $animals = Animal::where('idPerson', $user->id)->get();
            return response()->json(['message' => 'Animals found', 'data' => $animals], 200);
        }

    //ajouter un animal 
            public function addAnimal(Request $request)
        {
            try {
                $animal = new Animal([
                    'idPerson' => $request->input('idPerson'),
                    'idRace' => $request->input('idRace'),
                    'idCollier' => $request->input('idCollier'),
                    'name' => $request->input('name'),
                    'picture' => $request->input('picture'),
                    'birth' => $request->input('birth'),
                    'research' => $request->input('research')
                ]);

                $animal->save();

                return response()->json(['message' => 'Animal added successfully', 'data' => $animal], 201);
            } catch (QueryException $e) {
                return response()->json(['message' => 'Failed to add animal: ' . $e->getMessage()], 500);
            }
        }

    //supprimer un animal 
            public function deleteAnimal($id)
        {
            try {
                $animal = Animal::findOrFail($id);
                $animal->delete();

                return response()->json(['message' => 'Animal deleted successfully'], 200);
            } catch (QueryException $e) {
                return response()->json(['message' => 'Failed to delete animal: ' . $e->getMessage()], 500);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Animal not found'], 404);
            }
        }
        
    //modifier un animal 
            public function updateAnimal(Request $request, $id)
        {
            try {
                $animal = Animal::findOrFail($id);

                $fieldsToUpdate = $request->only(['idPerson', 'idRace', 'idCollier', 'name', 'picture', 'birth', 'research']);

                foreach ($fieldsToUpdate as $field => $value) {
                    if (!empty($value)) {
                        $animal->$field = $value;
                    }
                }

                $animal->save();

                return response()->json(['message' => 'Animal updated successfully', 'data' => $animal], 200);
            } catch (QueryException $e) {
                return response()->json(['message' => 'Failed to update animal: ' . $e->getMessage()], 500);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Animal not found'], 404);
            }
        }



}
