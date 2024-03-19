<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\CreditCard;

class CreditCardController extends Controller
{
    public function creditCard(Request $request): Response
    {
        // dd($request->all());
        $rules = [
            'card' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'pan_num' => 'required|string|max:255',
            'adhar_num' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'annual_income' => 'required|string|max:255',
            'residence_address' => 'required|string|max:255',
            'office_address' => 'required|string|max:255',
            'pan_file' => 'required|file|mimes:pdf|max:2048',
            'adhar_front_file' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'adhar_back_file' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'itr_file' => 'required|file|mimes:pdf|max:2048',
            'bank_statement_file' => 'required|file|mimes:pdf|max:2048',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response(['status' => false, 'errors' => $validator->errors()], 422);
        }
   
        $referral_id="";
        if (Auth::user()) {
            $referral_id = Auth::user()->referral_id;
        } else {
            $referral_id = "ertyfg12345";
        }

        $creditCard = CreditCard::create([
            'referred_by'=>$referral_id,
            'name'=>$request->name,
            'card' => $request->card,
            'pan_num' => $request->pan_num,
            'adhar_num' => $request->adhar_num,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'annual_income' => $request->annual_income,
            'residence_address' => $request->residence_address,
            'office_address' => $request->office_address,
        ]);

        if ($creditCard) {
            $documentFields = ['pan_file', 'adhar_front_file', 'adhar_back_file','itr_file','bank_statement_file'];

            foreach ($documentFields as $documentField) {
                
                if ($request->hasFile($documentField)) {
                    $document = $request->file($documentField);
                    $documentName = $document->hashName();                
                    $document->move(public_path('storage/credit-card'), $documentName);
                    // Set the document name to the respective column in the CreditCard model
                    $creditCard->$documentField = $documentName;
                }
            }
            $creditCard->save();
        }

        if ($creditCard) {     
            return Response(['status' => true, 'message' => "Credit card successfully !"], 200);
        }

        return Response(['status' => false, 'message' => "Something went wrong"], 500);
    }

    public function loanSubmit(Request $request): Response
    {
        // dd($request->all());
        $rules = [
            'loan_type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:10',
            'income_source' => 'required|string|max:255',
            'monthly_income' => 'required|numeric',
            'pincode' => 'required|string|max:6',
            'dob' => 'required|date',
            'pan_num' => 'required|string|max:10',
            'marital_status' => 'required|string|max:255',
            'adhar_num' => 'required|string|max:12',
            'loan_amount' => 'required|numeric',
            'credit_score' => 'required|numeric',
            'mother_name' => 'required|string|max:255',
            'document_type' => 'required|string|max:255',
            'upload_document' => 'required|file|mimes:pdf|max:2048', 
        ];
        
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        
        // Check if validation fails
        if ($validator->fails()) {
            return Response(['status' => false, 'errors' => $validator->errors()], 422);
        }
        dd("ok");
    }
}
