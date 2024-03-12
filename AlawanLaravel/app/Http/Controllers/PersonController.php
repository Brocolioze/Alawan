<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Person;
use App\Http\Resources\PersonResource;


class PersonController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->accessToken;
            
            return response()->json("Utilisateur existant : connexion complétée");
        }
        else
            return response()->json("Utilisateur inexistant : connexion impossible");
    }


    public function getAllPersons()
    {
        $persons = Person::all();

        return response()->json(['message' => 'Persons found', 'data' => $persons], 200);
    }


    public function getLoggedInPerson()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        else
            return response()->json(['message' => 'User found', 'data' => $user], 200);
    }


    public function addPerson(Request $request)
    {
        try {
            $person = new Person([
                'idAddress' => $request->input('idAddress'),
                'name' => $request->input('name'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'phone' => $request->input('phone'),
                'invite' => $request->input('invite'),
                'admin' => $request->input('admin'),
                'creationDate' => $request->input('creationDate')
            ]);

            $person->save();

            return response()->json(['message' => 'Person added successfully', 'data' => $person], 201);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add person: ' . $e->getMessage()], 500);
        }
    }


    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->token()->revoke();

        return response()->json(['message' => 'Logout successful'], 200);
    }


    public function deletePerson($id)
    {
        try {
            $person = Person::findOrFail($id);
            $person->delete();

            return response()->json(['message' => 'Person deleted successfully'], 200);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete person: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Person not found'], 404);
        }
    }
}
