<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

use App\Models\UserProfile;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : Response
    {
        $userId = Auth::user()->user_id; 
        if($userId == $id){
            $user = UserProfile::where('user_id', $id);
            if($user){
                $userData=$user->get();
                return Response(['user profile'=>$userData],200);
            }
            return Response(['message'=>"User not found"],404);
        }
        return Response(['message'=>'Unauthorized'],401);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=Auth::user();
        $userId = $user->user_id; 
        if($userId == $id){
            $formMethod = $request->method();
            if($formMethod == "PATCH"){
                $validator=Validator::make($request->all(),[
                    "date_of_birth"=> 'date_format:Y-m-d',
                    "gender"=>'string|in:"M","F","O"',
                    "age"=>'numeric|integer|min:1',
                    // "preffered_line"=> 'string|max:20',
                    // "spoc"=> 'string|max:60',  
                    // "preffered_line" =>$user->hasAnyRole(['Candidate', 'Insurer']) ? 'required|string|max:20' : 'nullable|string|max:20',
                    "preffered_line" =>$user->hasAnyCategory(['Candidate', 'Insurer']) ? 'required|string|max:20' : 'nullable|string|max:20',
                    "spoc" =>$user->hasAnyCategory(['Institute', 'Insurer']) ? 'required|string|max:60' : 'nullable|string|max:60',
                ]);

                if($validator->fails()){
                    return Response(['status'=>false,'errors' => $validator->errors()],422);
                }   

                $user= UserProfile::where('user_id', $id)->first();

                // $user = UserProfile::where('user_id', $id) ;
                if($user){
                    // dd($request->all());
                    $isUpdated=$user->update($request->all());
                    if($isUpdated){
                        return Response(['status'=>true,'message' => "User profile updated successfully"],200);
                    }
                    return Response(['status'=>false,'message' => "Something went wrong"],500);
                }                    
                return Response(['status'=>false,'message'=>"User not found"],404);
            }
            return Response(['status'=>false,'message'=>"Invalid form method "],405);
        }
        return Response(['status'=>false,'message'=>'Unauthorized'],401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     /**
     * Upload profile image
     */
    public function profileImageUpload(Request $request)
    {
        if(Auth::check()){
            $validator=Validator::make($request->all(),[
                'profile_image'=>'required|image|mimes:jpeg,png,jpg|max:150'
                // 'profile_image'=>'required|image|mimes:jpeg,png,jpg'
            ]);

            if($validator->fails()){
                return Response(['status'=>false,'errors' => $validator->errors()],422);
            } 
            
            // Save the image to the storage
            $image=$request->file("profile_image");
            $imageName=$image->hashName();

            // $imagepath= Storage::disk('local')->put('public/images', $image);
            // $imagepath = $image->storeAs('public/images', $imageName);
            $image->move(public_path('storage/images'), $imageName);
            $imagepath = public_path($imageName);

            if ($imagepath) {
                $userId = Auth::user()->user_id; 

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

                    // $oldimage=$user->profile_image;
                    // Storage::delete($oldimage);
                }
                $user->profile_image = $imageName;
                $user->save();
                return Response(['status'=>true,'message' => 'Image stored successfully', 'path' => $imagepath]);
            } else {
                // Image storage failed
                return Response(['status'=>false,'message' => 'Failed to store image'], 500);
            }            
        }
        return Response(['message'=>'Unauthorized'],401);
    }
}
