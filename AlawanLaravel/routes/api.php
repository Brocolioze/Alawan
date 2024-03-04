<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AnimalController;
use App\Http\Resources\PersonRessource;
use App\Models\Person;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//CRUD person
Route::post('/login', [PersonController::class, 'login']);
Route::middleware('auth:api')
        ->get('/persons', [PersonController::class, 'getAllPersons']);
Route::middleware('auth:api')
        ->get('/user', [PersonController::class, 'getLoggedInPerson']);
Route::post('/person', [PersonController::class, 'addPerson']);
Route::middleware('auth:api')
        ->post('/logout', [PersonController::class, 'logout']);
Route::delete('/person/{id}', [PersonController::class, 'deletePerson']);

//CRUD animal
Route::middleware('auth:api')
        ->get('/animals', [AnimalController::class, 'getAllAnimals']);
Route::middleware('auth:api')
        ->get('/animals/person', [AnimalController::class, 'getAnimalsOfLoggedInPerson']);
Route::middleware('auth:api')
        ->post('/animal', [AnimalController::class, 'addAnimal']);
Route::middleware('auth:api')
        ->delete('/animal/{id}', [AnimalController::class, 'deleteAnimal']);
Route::middleware('auth:api')
        ->put('/animal/{id}', [AnimalController::class, 'updateAnimal']);

//CRD  color
Route::get('/colors', [ColorController::class, 'getAllColors']);
Route::post('/color', [ColorController::class, 'addColor']);
Route::delete('/color/{id}', [ColorController::class, 'deleteColor']);

//CRD   race
Route::get('/races', [RaceController::class, 'getAllRaces']);
Route::post('/race', [RaceController::class, 'addRace']);
Route::delete('/race/{id}', [RaceController::class, 'deleteRace']);

Route::get('/persons', function(){
        return PersonRessource::collection(Person::all());
});