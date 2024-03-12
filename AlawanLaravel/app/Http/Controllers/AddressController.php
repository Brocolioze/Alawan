<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
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
                'city' => $request->input('city'),
                'street' => $request->input('street'),
                'doorNumber' => $request->input('doorNumber'),
                'postalCode' => $request->input('postalCode')
            ]);
    
            $address->save();
    
            return response()->json(['message' => 'Address added successfully', 'data' => $address], 201);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to add address: ' . $e->getMessage()], 500);
        }
    }

    public function deleteAddress($id)
    {
        try {
            $address = Address::findOrFail($id);
            $address->delete();

            return response()->json(['message' => 'Address deleted successfully'], 200);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete address: ' . $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Address not found'], 404);
        }
    }
}
