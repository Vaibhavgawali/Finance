<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\UserProfile;

class ProfileController extends Controller
{

    
     /**
     * Upload profile image
     */
    public function profileImageUpload(Request $request)
    {
        if(Auth::check()){

            $image_parts = explode(";base64,", $request->profile_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $imageName = uniqid().".".$image_type;

            // Check if the image type is one of the allowed types
            $allowed_image_types = ['jpeg', 'png', 'jpg'];
            if (!in_array($image_type, $allowed_image_types)) {
                return response()->json(['status' => false, 'errors' => ['profile_image' => ['Image must be jpg ,jpeg ,png only']]], 422);
            }

            // Decode the base64 data
            $image_base64 = base64_decode($image_parts[1]);

            // Calculate the image size in KB
            $image_size = strlen($image_base64) / 1024; 

            // Check if the image size exceeds the limit in KB
            $max_image_size = 150; 
            if ($image_size > $max_image_size) {
                return response()->json(['status' => false, 'errors' => ['profile_image' => ['Image size exceeds the maximum allowed size 150 kB.']]], 422);
            }

            $folderPath = public_path('storage/images/');
            $imagepath = $folderPath.$imageName;
            file_put_contents($imagepath, $image_base64);

            if ($imagepath) {
                $userId = Auth::user()->id; 
                // dd($userId);

                // Image is stored
                $user = UserProfile::where('user_id', $userId)->first();
                
                // Delete the old image
                if(isset($user->profile_image)){
                    $oldimage=$user->profile_image;
                    $oldImagePath = 'storage/images/'. $oldimage;
                    $oldImagePath = public_path($oldImagePath);

                    if (File::exists($oldImagePath)) {      
                        File::delete($oldImagePath);
                    }
                }
                $user->profile_image = $imageName;
                $user->save();
                return Response(['status'=>true,'message' => 'Image stored successfully', 'path' => $imagepath]);
            } else {
                return Response(['status'=>false,'message' => 'Failed to store image'], 500);
            }            
        }
        return Response(['message'=>'Unauthorized'],401);
    }
}
