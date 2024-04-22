<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserAddress;
use App\Models\UserDocuments;
use App\Models\AddressProofDocuments;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

     /**
     * Upload profile image
     */
    public function profileImageUpload(Request $request)
    {
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
            // $user = UserProfile::where('user_id', $userId)->first();
            $user = UserProfile::firstOrNew(['user_id' => $userId]);
            
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

     /**
     * Basic Details
     */
    public function BasicDetailsStoreOrUpdate(Request $request)
    {
        // dd($request->all());
       
        $AuthUserId=Auth::user()->id;
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);

        if($userId == $AuthUserId){

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                // 'email' => 'required|email|unique:users,email',
                'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/',
                'father_name' => 'required|string',
                "date_of_birth"=> 'required|date_format:Y-m-d',
                "alt_phone" => 'numeric|digits:10|regex:/^[6-9]\d{9}$/',
                "pan"=> 'required|regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/',
                "address"=> 'required|string|max:30',
                "city"=> 'required|string|max:30',
                "state"=> 'required|string|max:20',
                "pincode"=> 'required|numeric|digits:6',
                "gst" => 'required|in:0,1', 
                "msme" => 'required|in:0,1',
                "gst_number" => $request->gst == '1' ? 'required' : '',
                "msme_number" => $request->msme == '1' ? 'required' : '',
            ]);
    
            if ($validator->fails()) {
                return Response(['status' => false, 'errors' => $validator->errors()], 422);
            }

            $user->update($request->only(['name','phone'])); //email

            // Update profile if it exists, or create a new one
            $user->profile()->updateOrCreate([], $request->only([
                'father_name', 'date_of_birth', 'pan', 'alt_phone', 'gst', 'msme'
            ]));

            // Update address if it exists, or create a new one
            $user->address()->updateOrCreate([], $request->only([
                'address', 'city', 'state', 'pincode'
            ]));

            // Update msme number if it exists, or create a new one
            if ($request->msme == '1') {
                $user->business()->updateOrCreate(
                    ['document_title' => 'msme'],
                    ['document_number' => $request->msme_number]
                );
            }
            
            // Update gst number if it exists, or create a new one
            if ($request->gst == '1') {
                $user->business()->updateOrCreate(
                    ['document_title' => 'gst'],
                    ['document_number' => $request->gst_number]
                );
            }

            return response()->json(['status' => true,'message' => 'Basic details updated successfully'], 200);
        }
    }

     /**
     * Bank Details
     */
    public function BankDetailsStoreOrUpdate(Request $request)
    {
        // dd($request->)
        $AuthUserId=Auth::user()->id;
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        if($userId == $AuthUserId){

            $validator = Validator::make($request->all(), [
                'bank_name' => 'required|string',
                'acc_holder_name' => 'required|string',
                'acc_number' => 'required|string',
                'ifsc_code' => 'required|string',
                // 'ifsc_code' => 'required|regex:/^[A-Za-z]{4}0[A-Z0-9a-z]{6}$/',
                'facebook' => 'nullable|url',
                'instagram' => 'nullable|url',
                'linkedin' => 'nullable|url',
                'twitter' => 'nullable|url',
                'telegram' => 'nullable|url',
            ]);
    
            if ($validator->fails()) {
                return Response(['status' => false, 'errors' => $validator->errors()], 422);
            }

            // Update bank details if it exists, or create a new one
            $user->bank()->updateOrCreate([], $request->only([
                'bank_name', 'acc_holder_name', 'acc_number', 'ifsc_code'
            ]));

            // update social links 
            $socialLinksData = [
                'Facebook' => $request->facebook,
                'Instagram' => $request->instagram,
                'LinkedIn' => $request->linkedin,
                'Twitter' => $request->twitter,
                'Telegram' => $request->telegram,
            ];
            
            foreach ($socialLinksData as $socialSite => $profileUrl) {
                // Check if the profile URL is not empty before updating or creating
                if ($profileUrl !== null && $profileUrl !== '') {
                    $user->social_links()->updateOrCreate(
                        ['social_site' => $socialSite],
                        ['profile_url' => $profileUrl]
                    );
                }
            }

            return response()->json(['status' => true,'message' => 'Bank details updated successfully'], 200);
        }
    }
    
     /**
     * Professional Details
     */
    public function ProfessionalDetailsStoreOrUpdate(Request $request)
    {
        // dd($request->all());

        $AuthUserId=Auth::user()->id;
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        if($userId == $AuthUserId){

            $validator = Validator::make($request->all(), [
                'profession' => 'required|string',
                'monthly_income' => 'required|string|in:1,2,3,4,5',
                'company_name' => 'nullable|string',
                'domain' => 'required|string|in:Insurance,Loan,Sales,Marketing,Telecom,Other',
                'other_domain' => $request->domain == 'Other'? 'required|string':'nullable',
            ]);
    
            if ($validator->fails()) {
                return Response(['status' => false, 'errors' => $validator->errors()], 422);
            }

            // Check if the 'domain' is 'Other', and 'other_domain' is provided, then replace 'domain' with 'other_domain'
            $domain = $request->domain;
            if ($request->domain === 'Other' && $request->filled('other_domain')) {
                $domain = $request->other_domain;
            } 

            // data to be updated
            $professionData = [
                'profession' => $request->profession,
                'monthly_income' => $request->monthly_income,
                'company_name' => $request->company_name,
                'domain' => $domain, // Use the possibly modified domain here
            ];

            // Update professional details if it exists, or create a new one
            $user->profession()->updateOrCreate([], $professionData);

            return response()->json(['status' => true,'message' => 'Professional details updated successfully'], 200);
        }
    }

    /**
     * KYC Details 
     */
    public function KycDetailsStore(Request $request)
    {
        // dd($request->all());
        $AuthUserId = Auth::user()->id;
        $userId = $request->input('user_id');
        
        $user = User::findOrFail($userId);
        if($userId == $AuthUserId){

            $validator = Validator::make($request->all(), [
                'pan_card' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
                'cancel_cheque' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
                'address_proof' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
                'address_proof_name' => 'required',
                'document_number' => 'required',
                'partner_photo' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            ]);
        
            if ($validator->fails()) {
                return Response(['status' => false, 'errors' => $validator->errors()], 422);
            }

            // Save each document to the storage and update the database records
            try {
                foreach (['pan_card', 'cancel_cheque', 'address_proof', 'partner_photo'] as $documentField) {

                    $document = $request->file($documentField);
                    $documentName = $document->hashName();
                    $document->move(public_path('storage/documents'), $documentName);

                    $userDocument = $user->documents()->where('document_type', $documentField)->first();
                    
                    // Delete the old document if it exists
                    if ($userDocument && $userDocument->document_url) {
                        $oldDocumentPath = public_path('storage/documents') . '/' . $userDocument->document_url;
                        if (File::exists($oldDocumentPath)) {
                            File::delete($oldDocumentPath);
                        }
                    }
                    
                    // Update or create the record in the database
                    if ($userDocument) {
                        $userDocument->update([
                            'document_title' => $request->input($documentField, $userDocument->document_title),
                            'document_url' => $documentName,
                            'status' => 'active' 
                        ]);
                    } else {
                        $user->documents()->create([
                            'document_title' => $request->input($documentField),
                            'document_type' => $documentField,
                            'document_url' => $documentName,
                            'status' => 'active' 
                        ]);
                    }
                }

                // address proof related details
                $addressProofDocument = $request->file('address_proof');
                if ($addressProofDocument) {
                    $userDocument = $user->documents()->where('document_type', 'address_proof')->first();
                    $addressProofDocuments = $userDocument->address_proof()->updateOrCreate(
                        ['user_document_id' => $userDocument->id],
                        [
                            'document_number' => $request->document_number,
                            'address_proof_name' => $request->address_proof_name,
                        ]
                    );
                }

                // Return success response
                return response()->json(['success' => true], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'An error occurred.'], 500);
            }
        }
    }

    // Method to update a specific document
    public function KycDetailsUpdate(Request $request)
    {
        dd($request->all());
        $AuthUserId = Auth::user()->id;
  
        $user = User::findOrFail($AuthUserId);

        $validator = Validator::make($request->all(), [
        'document_type' => 'required|string', 
        'file' => $request->document_type == 'partner_photo' ? 'required|file|mimes:jpg,jpeg,png|max:2048' : 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 
        'document_number' => $request->document_type == 'address_proof' ? 'required|string' :'',
        'address_proof_name' => $request->document_type == 'address_proof' ? 'required|string' :'',
        ]);

        if ($validator->fails()) {
            return Response(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $user = auth()->user(); 

        $documentType=$request->document_type;

        $userDocument = $user->documents()->where('document_type', $documentType)->first();

        // Check if the document exists
        if ($userDocument) {

            if ($request->hasFile('file')) {
                $document = $request->file('file');

                $documentName = $document->hashName();
                $document->move(public_path('storage/documents'), $documentName);

                // Delete the old document if it exists
                if ($userDocument->document_url) {
                    $oldDocumentPath = public_path('storage/documents') . '/' . $userDocument->document_url;
                    if (File::exists($oldDocumentPath)) {
                        File::delete($oldDocumentPath);
                    }
                }

                $userDocument->document_url = $documentName;
                $userDocument->save();
            }

            // address proof related details
            if ($documentType == "address_proof") {
                $addressProofDocuments = $userDocument->address_proof()->updateOrCreate(
                    ['user_document_id' => $userDocument->id],
                    [
                        'document_number' => $request->document_number,
                        'address_proof_name' => $request->address_proof_name,
                    ]
                );
            }

            return response()->json(['status' => true,'message' => 'Document updated successfully'], 200);
        } else {
            return response()->json(['status' => false,'error' => 'Document not found'], 404);
        }
    }
}
