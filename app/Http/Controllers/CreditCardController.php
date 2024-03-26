<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\CreditCard;
use App\Models\Loan;
use App\Models\LoanAddress;
use App\Models\Demat;

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
            'pan_file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'adhar_front_file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'adhar_back_file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'itr_file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'bank_statement_file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
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
            'upload_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 

            'present_line1' => 'required|string',
            'present_line2' => 'nullable|string',
            'present_line3' => 'nullable|string',
            'present_landmark' => 'nullable|string',
            'present_state' => 'required|string',
            'present_city' => 'required|string',
            'present_pincode' => 'required|string|max:6',
            'present_phone' => 'nullable|string',
        
            'office_line1' => 'nullable|string',
            'office_line2' => 'nullable|string',
            'office_line3' => 'nullable|string',
            'office_landmark' => 'nullable|string',
            'office_state' => 'nullable|string',
            'office_city' => 'nullable|string',
            'office_pincode' => 'nullable|string|max:6',
            'office_phone' => 'nullable|string',
        ];
        
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        
        // Check if validation fails
        if ($validator->fails()) {
            return Response(['status' => false, 'errors' => $validator->errors()], 422);
        }
        // dd("ok");
        $referral_id="";
        if (Auth::user()) {
            $referral_id = Auth::user()->referral_id;
        } else {
            $referral_id = "ertyfg12345";
        }

        $loan = Loan::create([
            'referred_by' => $referral_id,
            'loan_type' => $request->loan_type,
            'mobile' => $request->mobile,
            'name' => $request->name,
            'income_source' => $request->income_source,
            'email' => $request->email,
            'monthly_income' => $request->monthly_income,
            'pincode' => $request->pincode,
            'adhar_num' => $request->adhar_num,
            'dob' => $request->dob,
            'loan_amount' => $request->loan_amount,
            'pan_num' => $request->pan_num,
            'credit_score' => $request->credit_score,
            'marital_status' => $request->marital_status,
            'mother_name' => $request->mother_name,
            'document_type' => $request->document_type,
        ]);
        
        if ($loan) {   
             
            $loan->loan_address()->updateOrCreate([], $request->only([
                'present_line1', 'present_line2', 'present_line3', 'present_landmark',
                'present_state', 'present_city', 'present_pincode', 'present_phone',
                'office_line1', 'office_line2', 'office_line3', 'office_landmark',
                'office_state', 'office_city', 'office_pincode', 'office_phone',
            ]));

            if ($request->hasFile('upload_document')) {
                $document = $request->file('upload_document');
                $documentName = $document->hashName();                
                $document->move(public_path('storage/loan'), $documentName);

                $loan->upload_document = $documentName;
            }
            $loan->save();

           
            return Response(['status' => true, 'message' => "Loan created successfully !"], 200);
        }

        return Response(['status' => false, 'message' => "Something went wrong"], 500);
    }

    public function dematSubmit(Request $request): Response
    {
        // dd($request->all());

        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'pan_num' => ['required', 'string', 'max:10', 'regex:/^[A-Z]{5}\d{4}[A-Z]$/'],
            'adhar_num' => ['required', 'string', 'max:12', 'regex:/^\d{12}$/'],
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        
        // Check if validation fails
        if ($validator->fails()) {
            return Response(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $referral_id="";
        if (Auth::user()) {
            $referral_id = Auth::user()->referral_id;
        } else {
            $referral_id = "ertyfg12345";
        }

        $demat = Demat::create([
            'referred_by'=>$referral_id,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'pan_num' => $request->pan_num,
            'adhar_num' => $request->adhar_num,
        ]);

        if ($demat) {     
            return Response(['status' => true, 'message' => "Demat submitted successfully !"], 200);
        }

        return Response(['status' => false, 'message' => "Something went wrong"], 500);

    }
}
