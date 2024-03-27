<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Animal;
use App\Models\AnimalColor;
use App\Models\Alert;
use App\Models\Person;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\PersonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;



class AnimalController extends Controller
{
    public function getAllAnimals()
    {
        $animals = Animal::all();
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

    
    public function getAnimalsOfLoggedInPerson(Request $request)
    {
        try{
            $user = Person::findOrFail($request->id);
            $animals = Animal::where('idPerson', $user->id)->get();
            if($animals != null){
                foreach($animals as $animal){
                    if($animal->research == 1){
                        $animal->research = true;
                    }
                    else{
                        $animal->research = false;
                    }
                }
            }
            return response()->json($animals);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json();
        }
        catch (\Exception $e) {
            Log::debug($e);
            return response()->json();
        }
            
        
    }

    public function addAnimal(Request $request)
    {
        try {
            Log::debug("tu es dedans");
            $animal = new Animal([
                'idPerson' => $request->input('idPerson'),
                'idRace' => $request->input('idRace'),
                'idNecklace' => null,
                'name' => $request->input('name'),
                'picture' => $request->input('picture'),
                'birth' => $request->input('birth'),
                'research' => $request->input('research')
            ]);

            if($animal->birth != null){
                $animal->birth = Carbon::parse($animal->birth)->format('Y-m-d');
                Log::debug($animal->birth);
            }

            if($animal->research = true){
                $animal->research = 1;
            }
            else{
                $animal->research = 0;
            }
            $animal->save();
            log::debug($animal);
            log::debug($animal->id);
            return response()->json($animal->id);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json(['message' => 'Failed to add animal: ' . $e->getMessage()], 500);
        }
    }


    public function deleteAnimal($id)
    {
        try {
            $animal = Animal::findOrFail($id);
            $animalColors = AnimalColor::where('idAnimal',$animal->id)->get();
            $alerts = Alert::where('idAnimal',$animal->id)->get();
            if($alerts != null){
                foreach($alerts as $alert){
                    $alert->delete();
                }
            } 
            if($animalColors != null){
                foreach($animalColors as $animalColor){
                    $animalColor->delete();
                }
            }
            $animal->delete();
            return response()->json(true);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json(false);
        }
        catch (\Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
        catch(\Throwable $e){
            Log::debug($e);
            return response()->json(false);
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
            $alerts = Alert::whereIn('idAnimal',$animalIds)->whereNull('dateFind')->get();
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
            $alert = Alert::where('idAnimal',$request->id)->first();
            $alert->dateFind = Carbon::now()->format('Y-m-d');
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


    public function findAnimalfromAlert(Request $request){
        try{
            $animal = Animal::findOrFail($request->id);
            if($animal->research == 1){
                $animal->research = true;
            }
            else{
                $animal->research = false;
            }
            return response()->json($animal);
        }
        catch (QueryException $e) {
            Log::debug($e);
            return response()->json(['message' => 'Failed to get animal: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::debug($e);
        return response()->json(['message' => 'Animal not found'], 404);
        }
    }

}
    