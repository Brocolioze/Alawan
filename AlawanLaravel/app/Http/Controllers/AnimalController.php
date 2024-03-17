<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Animal;
use App\Models\Alert;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\PersonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;



class AnimalController extends Controller
{
    public function getAllAnimals()
    {
        Log::debug("dedans");
        $animals = Animal::all();
        foreach($animals as $animal){
            if($animal->research == 1){
                $animal->research = true;
            }
            else{
                $animal->research = false;
            }
        }
        Log::debug($animals);
        return response()->json($animals);
    }

    /*
    public function getAnimalsOfLoggedInPerson()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);

    //afficher les animaux admin 
          
        $animals = Animal::where('idPerson', $user->id)->get();
        return response()->json(['message' => 'Animals found', 'data' => $animals], 200);
    }
    */


    public function addAnimal(Request $request)
    {
        try {
            $animal = new Animal([
                'idPerson' => $request->input('idPerson'),
                'idRace' => $request->input('idRace'),
                'idNecklace' => $request->input('idNecklace'),
                'name' => $request->input('name'),
                'picture' => $request->input('picture'),
                'birth' => $request->input('birth'),
                'research' => $request->input('research')
            ]);

            $animal->save();

            return response()->json(['message' => 'Animal added successfully', 'data' => $animal], 201);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add animal: ' . $e->getMessage()], 500);
        }
    }


    public function deleteAnimal($id)
    {
        try {
            $animal = Animal::findOrFail($id);
            $animal->delete();

            return response()->json(['message' => 'Animal deleted successfully'], 200);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete animal: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Animal not found'], 404);
        }
    }
    
    
    public function updateAnimal(Request $request, $id)
    {
        try {
            $animal = Animal::findOrFail($id);

            $fieldsToUpdate = $request->only(['idPerson', 'idRace', 'idCollier', 'name', 'picture', 'birth', 'research']);

            foreach ($fieldsToUpdate as $field => $value)
            {
                if (!empty($value))
                {
                    $animal->$field = $value;
                }
            }

            $animal->save();

            return response()->json(['message' => 'Animal updated successfully', 'data' => $animal], 200);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to update animal: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Animal not found'], 404);
        }
     }


    public function getAnimalAlertProfil(Request $request)
    {
        try{
            $animals = Animal::where('idPerson',$request->id)->get();
            $animalIds = $animals->pluck('id')->toArray();
            $alerts = Alert::where('idAnimal',$animalIds)->where('dateFind',NULL)->get();
            $alertIds = $alerts->pluck('idAnimal')->toArray();
            $animals = Animal::whereIn('id',$alertIds)->get();
            foreach($animals as $animal){
                if($animal->research == 1){
                    $animal->research = true;
                }
                else{
                    $animal->research = false;
                }
        }
            return response()->json($animals);
        }catch (QueryException $e) {
            return response()->json(['message' => 'Failed to update animal: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::debug($e);
            return response()->json(['message' => 'Animal not found'], 404);
        }
    }


    public function getAnimalAlert()
    {
        try{
            $alerts = Alert::where('dateFind',null)->get();
            $alertIds = $alerts->pluck('idAnimal')->toArray();
            $animals = Animal::whereIn('id',$alertIds)->get(); 
            foreach($animals as $animal){
                if($animal->research == 1){
                    $animal->research = true;
                }
                else{
                    $animal->research = false;
                }
            }
            return response()->json($animals);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json(['message' => 'Failed to update animal: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            Log::debug($e);
            return response()->json(['message' => 'Animal not found'], 404);
        }
    }


    public function finAlertProfil(Request $request)
    {
        try{
            Log::debug("tu es dedans");
            $alert = Alert::where('idAnimal',$request->id)->first();
            Log::debug($alert);
            $alert->dateFind = Carbon::now()->format('Y-m-d');
            Log::debug(Carbon::now()->format('Y-m-d'));
            $alert->save();
            return response()->json(true);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json(['message' => 'Failed to update animal: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::debug($e);
        return response()->json(['message' => 'Animal not found'], 404);
        }
    }

}
    