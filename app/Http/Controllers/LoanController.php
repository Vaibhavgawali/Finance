<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PDF;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Loan;

class LoanController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $users = Loan::with('loanRefer')->orderBy('id', 'desc')->get();
            
            if ($users) {
                return view('dashboard.services.loan-list');
            }
        }
        return Response(['data' => 'Unauthorized'], 401);
    }

    public function getLoanTableData(Request $request)
    {
        if (Auth::check()) {
            $data = Loan::with('loanRefer')
                    ->when(request()->has('incomeSourecFilter'), function ($query) {
                        $incomeSourecFilter = request('incomeSourecFilter');
                        $query->where('income_source', 'like', '%' . $incomeSourecFilter . '%');
                    })
                    ->when(request()->has('statusFilter'), function ($query) {
                        $statusFilter = request('statusFilter');
                        $query->where('status', 'like', '%' . $statusFilter . '%');
                    })
                    ->when(request()->has('search'), function ($query) {
                        $search = request('search');
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('mobile', 'like', '%' . $search . '%')
                            ->orWhere('status', 'like', '%' . $search . '%')
                            ->orWhere('loan_type', 'like', '%' . $search . '%')
                            ->orWhere('loan_amount', 'like', '%' . $search . '%')
                            ->orWhere('application_stage', 'like', '%' . $search . '%')
                            ->orWhere('approval_date', 'like', '%' . $search . '%')
                            ->orWhere('remark', 'like', '%' . $search . '%')
                            ->orWhereHas('loanRefer', function ($q) use ($search) {
                                $q->where('name', 'like', '%' . $search . '%');
                            });
                        });
                    })
                    ->when(request()->filled('startDate') || request()->filled('endDate'), function ($query) {
                        $startDate = request()->filled('startDate') ? Carbon::parse(request('startDate'))->startOfDay() : null;
                        $endDate = request()->filled('endDate') ? Carbon::parse(request('endDate'))->endOfDay() : Carbon::now()->endOfDay();
                        
                        if ($startDate === null && $endDate !== null) {
                            $query->where('created_at', '<=', $endDate);
                        } else if ($startDate !== null && $endDate === null) {
                            $query->where('created_at', '>=', $startDate);
                        } else {
                            $query->whereBetween('created_at', [$startDate, $endDate]);
                        }
                    })
                    ->when(Auth::user()->hasRole('Distributor') || Auth::user()->hasRole('Retailer'), function ($query) {
                        $logged_user_referral_id = auth()->user()->referral_id;
                        $query->where(function ($q) use ($logged_user_referral_id) {
                            $q->where('referred_by', $logged_user_referral_id)
                              ->orWhereHas('loanRefer', function ($q) use ($logged_user_referral_id) {
                                  $q->where('referred_by', $logged_user_referral_id);
                              });
                        });
                    })
                    ->orderBy('id', 'desc')
                    ->get();
                        //  dd($data);     
            if ($data) { 
                    return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('actions', function ($row) {
                            // Check if user has Superadmin or Admin role
                            if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin')) {
                                $actions = '<a class="btn btn-sm btn-gradient-warning btn-rounded editButton" data-loan-id="' . $row->id . '" >Edit</a>';  
                                return $actions;
                            } else {
                                return '';
                            }
                        })
                        ->rawColumns(['actions'])
                        ->make(true);                                                                                                                                                                                                                                                 
            }
        }
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

        $referral_id="";
        if (Auth::user()) {
            $referral_id = Auth::user()->referral_id;
        } else {
            $referral_id = "ghijk12345";
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
            'status' => 'Initiated'
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Auth::Check()){
            $loan = Loan::find($id);
        
            if($loan) {
                $status = $loan->status;
                $application_stage = $loan->application_stage;
                $approval_date = $loan->approval_date;
                $remark = $loan->remark;

                return response()->json([
                    'status' => $status,
                    'application_stage' => $application_stage,
                    'approval_date' => $approval_date,
                    'remark' => $remark,
                ]);

            } else {
                return response()->json(['error' => 'Loan not found'], 404);
            }
        }
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
        if(Auth::Check()){
            $formMethod = $request->method();
            if($formMethod == "PATCH"){
                // Find the credit card record by its ID
                $loan = Loan::findOrFail($id);
// dd($loan);
                $validator = Validator::make($request->all(), [
                    'status' => 'required|string',
                    'application_stage' => 'nullable|string',
                    'approval_date' => 'nullable|date',
                    'remark' => 'nullable|string',
                ]);

                if($validator->fails()){
                    return Response(['message' => $validator->errors()],401);
                } 

                $isUpdated=$loan->update($request->all());
                if($isUpdated){
                    return Response(['message' => "Loan updated successfully"],200);
                }
                return Response(['message' => "Something went wrong"],500);
            }
            return Response(['message'=>"Invalid form method "],405);
        }
        return Response(['message'=>'Unauthorized'],401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
