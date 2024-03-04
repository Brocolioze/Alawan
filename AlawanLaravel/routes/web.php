<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Person;
use App\Http\Resources\PersonResource;
use App\Http\Controllers\PersonController;

use App\Models\Animal;
use App\Http\Resources\AnimalResource;
use App\Http\Controllers\AnimalController;

use App\Models\Adresse;
use App\Http\Resources\AdresseResource;
use App\Http\Controllers\AdresseController;

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


Route::get('/', function () {
    return view('mainPage');
});


//    LOGIN   //////////////////////////////////////////////////////////////////

Route::post('/login', [PersonController::class, 'login']);


//   PERSONS   //////////////////////////////////////////////////////////////////

Route::get('/persons', function(){
    return PersonResource::collection(Person::all());
});


//   ANIMALS   //////////////////////////////////////////////////////////////////

Route::middleware('auth:api')
        ->get('/animals', [AnimalController::class, 'getAllAnimals']);


//   COLORS   //////////////////////////////////////////////////////////////////

Route::get('/colors', [ColorController::class, 'getAllColors']);