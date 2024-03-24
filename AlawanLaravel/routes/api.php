<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Person;
use App\Http\Resources\PersonResource;
use App\Http\Controllers\PersonController;

use App\Models\Animal;
use App\Http\Resources\AnimalResource;
use App\Http\Controllers\AnimalController;

use App\Models\Address;
use App\Http\Resources\AddressResource;
use App\Http\Controllers\AddressController;

use App\Models\Alert;
use App\Http\Resources\AlertResource;
use App\Http\Controllers\AlertController;

use App\Models\AnimalColor;
use App\Http\Resources\AnimalColorResource;
use App\Http\Controllers\AnimalColorController;

use App\Models\Color;
use App\Http\Resources\ColorResource;
use App\Http\Controllers\ColorController;

use App\Models\Necklace;
use App\Http\Resources\NecklaceResource;
use App\Http\Controllers\NecklaceController;

use App\Models\Race;
use App\Http\Resources\RaceResource;
use App\Http\Controllers\RaceController;

use App\Http\Controllers\ImageController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) { return $request->user(); });
Route::post('/enregistrer-rfid', function () { return response()->file(public_path('enregistrer_rfid.php')); });


// __ PERSON ______________________________________________________________

Route::post('/login', [PersonController::class, 'login']);
Route::post('/person', [PersonController::class, 'addPerson']);
Route::delete('/person/{id}', [PersonController::class, 'deletePerson']);
Route::get('/persons', function(){ return PersonResource::collection(Person::all()); });
Route::get('/getIdAuth', [PersonController::class, 'getIdAuth']);
Route::post('/invite', [PersonController::class, 'setInvite']);
Route::middleware('auth:api')->get('/persons', [PersonController::class, 'getAllPersons']);
Route::middleware('auth:api')->get('/user', [PersonController::class, 'getLoggedInPerson']);
Route::middleware('auth:api')->post('/logout', [PersonController::class, 'logout']);
Route::post('/getMaster', [PersonController::class, 'getMaster']);


// __ EMAIL ______________________________________________________________ 

Route::get('/emails', [PersonController::class, 'getAllEmails']);


// __ ANIMAL ______________________________________________________________ 

Route::get('/animals', [AnimalController::class, 'getAllAnimals']);
Route::post('/animal', [AnimalController::class, 'addAnimal']);
Route::delete('/animal/{id}', [AnimalController::class, 'deleteAnimal']);
Route::post('/animals/person', [AnimalController::class, 'getAnimalsOfLoggedInPerson']);


// __ COLOR _______________________________________________________________

Route::get('/colors', [ColorController::class, 'getAllColors']);
Route::get('/getColor', [ColorController::class, 'getColor']);
Route::post('/color', [ColorController::class, 'addColor']);
Route::delete('/color/{id}', [ColorController::class, 'deleteColor']);


// __ RACE ________________________________________________________________

Route::get('/races', [RaceController::class, 'getAllRaces']);
Route::get('/getRace/{id}', [RaceController::class, 'getRace']);
Route::post('/getRaceAnimal',[RaceController::class, 'getRaceAnimal']);
Route::post('/race', [RaceController::class, 'addRace']);
Route::delete('/race/{id}', [RaceController::class, 'deleteRace']);


// __ ADDRESS _____________________________________________________________

Route::get('/addresses', [AddressController::class, 'getAllAddresses']);
Route::post('/address', [AddressController::class, 'addAddress']);
Route::delete('/address/{id}', [AddressController::class, 'deleteAddress']);


// __ ALERT _______________________________________________________________

Route::get('/alerts', [AlertController::class, 'getAllAlerts']);
Route::post('/alert', [AlertController::class, 'addAlert']);
Route::delete('/alert/{id}', [AlertController::class, 'deleteAlert']);
Route::post('/getAlert', [AlertController::class, 'getAlert']);


// __ ANIMAL ALERT ________________________________________________________

Route::post('/animalFromAlert',[AnimalController::class, 'findAnimalfromAlert']);
Route::post('/animalAlertProfil',[AnimalController::class, 'getAnimalAlertProfil']);
Route::get('/animalAlert',[AnimalController::class, 'getAnimalAlert']);
Route::post('/finAlert',[AnimalController::class, 'finAlertProfil']);


// __ NECKLACE ____________________________________________________________

Route::get('/necklaces', [NecklaceController::class, 'getAllNecklaces']);
Route::post('/necklace', [NecklaceController::class, 'addNecklace']);
Route::delete('/necklace/{id}', [NecklaceController::class, 'deleteNecklace']);


// __ IMAGES ____________________________________________________________

Route::post('/uploadImage', [ImageController::class, 'uploadImage']);