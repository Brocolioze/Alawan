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


Route::get('/', function () {
    return view('mainPage');
});
