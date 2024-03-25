<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Decode the base64 encoded image
        $imageData = $request->input('image_data');
        $decodedImage = base64_decode($imageData);

        // Save the image to storage
        $imageName = 'image_' . time() . '.png'; // Or use any other suitable naming convention
        file_put_contents(public_path('img/' . $imageName), $decodedImage);

        // You can also save image details to a database if needed

        return response()->json([$imageName]);
    }
}