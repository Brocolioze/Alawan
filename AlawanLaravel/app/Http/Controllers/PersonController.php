<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Person;
use App\Http\Resources\PersonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class PersonController extends Controller
{
    public function login(Request $request)
    {
        Log::debug(Hash::make($request->password));
        Log::debug($request->password);
        //$credentials = $request->only('email', 'password');
        //Log::debug($credentials);
        Log::debug(Auth::attempt(['email' => $request->email, 'password' => $request->password]));
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Log::debug("tu te connectes");
            $user = Auth::user();
            Log::debug( $user);
            //$token = $user->createToken('AuthToken')->accessToken;
            return response()->json(true);
        }
        else{
            Log::debug("pas bon");
            return response()->json(false);
        }

            
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
        try
        {
            $person = new Person([
                'idAddress' => $request->input('idAddress'),
                'name' => $request->input('name'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'phone' => $request->input('phone'),
                'invite' => 0,
                'admin' => 0,
                'creationDate' => Carbon::now()->format('Y-m-d'),
            ]);

            $person->save();

            return response()->json(true);
        }
        catch (QueryException $e){
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


    public function getAuth(){
        try{
            Log::debug("tu es dedans");
            $user = Auth::user();
            Log::debug("L'usager connecter");
            Log::debug($user);
            return($user->id);
        }
        catch(\Exception $e){
            Log::debug($e);
            return(0);

    public function verifyEmail($email)
    {
        try {
            $mail = Person::findOrFail($email);

            return response()->json(['message' => 'This email is already in use'], 200);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Email not found'], 404);

        }
    }
}
