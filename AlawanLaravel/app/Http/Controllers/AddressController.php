<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Resources\AddressResource;

class AddressController extends Controller
{
    public function getAllAddresses()
    {
        return AddressResource::collection(Address::all());
    }

    public function addAddress(Request $request)
    {
        try {
            $address = new Address([
                'id' => $request->input('id'),
                'city' => $request->input('city'),
                'street' => $request->input('street'),
                'doorNumber' => $request->input('doorNumber'),
                'postalCode' => $request->input('postalCode')
            ]);
    
            $address->save();
    
            return response()->json(['message' => 'Address added successfully', 'data' => $address], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add address: ' . $e->getMessage()], 500);
        }
    }
}
