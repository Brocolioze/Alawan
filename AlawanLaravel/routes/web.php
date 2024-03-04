<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use App\Http\Controllers\AnimalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('mainPage');
});

Route::get('/persons', function(){
    return PersonResource::collection(Person::all());
});

//route::get('/animal',[AnimalController::class, 'getAllAnimals']);
Route::middleware('auth:api')
        ->get('/animals', [AnimalController::class, 'getAllAnimals']);