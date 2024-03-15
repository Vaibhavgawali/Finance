<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreditCardController extends Controller
{
    public function creditCard(Request $request): Response
    {
        $rules = [
            'referred_by'=>'required',
            'bank_name' => 'required|string|max:255',
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

        'pan_file' => $request->file('pan_file')->store('uploads'),
        'adhar_front_file' => $request->file('adhar_front_file')->store('uploads'),
        'adhar_back_file' => $request->file('adhar_back_file')->store('uploads'),

        $document = $request->file($documentField);
        $documentName = $document->hashName();
        $document->move(public_path('storage/documents'), $documentName);

        if ($userDocument && $userDocument->document_url) {
            $oldDocumentPath = public_path('storage/documents') . '/' . $userDocument->document_url;
            if (File::exists($oldDocumentPath)) {
                File::delete($oldDocumentPath);
            }
        }

        $crediCard = CreditCard::create([
            'referred_by'=>$request->referred_by,
            'bank_name' => $request->bank_name,
            'pan_num' => $request->pan_num,
            'adhar_num' => $request->adhar_num,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'annual_income' => $request->annual_income,
            'residence_address' => $request->residence_address,
            'office_address' => $request->office_address,
            'itr_file' => $request->file('itr_file')->store('uploads'),
            'bank_statement_file' => $request->file('bank_statement_file')->store('uploads'),
        ]);

        if ($crediCard) {     
            return Response(['status' => true, 'message' => "Credit card successfully !"], 200);
        }

        return Response(['status' => false, 'message' => "Something went wrong"], 500);
    }
}
