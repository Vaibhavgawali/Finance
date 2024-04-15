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

use App\Models\CreditCard;

class CreditCardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('create','store');
        $this->middleware(['role:Superadmin|Admin'])->only('show','edit','update','updateStatus');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $users = CreditCard::with('creditCardRefer')->orderBy('id', 'desc')->get();
            
            if ($users) {
                return view('dashboard.services.credit-card-list');
            }
        }
        return Response(['data' => 'Unauthorized'], 401);
    }

    public function getCreditCardTableData(Request $request)
    {
        $data = CreditCard::with('creditCardRefer')
                ->when(request()->has('bankFilter'), function ($query) {
                    $bankFilter = request('bankFilter');
                    $query->where('card', 'like', '%' . $bankFilter . '%');
                })
                ->when(request()->has('search'), function ($query) {
                    $search = request('search');
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('mobile', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhere('card', 'like', '%' . $search . '%')
                        ->orWhere('application_stage', 'like', '%' . $search . '%')
                        ->orWhere('approval_date', 'like', '%' . $search . '%')
                        ->orWhereHas('creditCardRefer', function ($q) use ($search) {
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
                            ->orWhereHas('creditCardRefer', function ($q) use ($logged_user_referral_id) {
                                $q->where('referred_by', $logged_user_referral_id);
                            });
                    });
                })
                ->orderBy('id', 'desc')
                ->get();
                            
        if ($data) { 
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($row) {
                        if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin')) {
                            $actions = '<div class="d-flex justify-content-center gap-2"> <a class="btn btn-sm btn-gradient-primary btn-rounded viewButton" data-credit-card-id="' . $row->id . '" >View</a>';  
                            // $actions .= '<a class="btn btn-sm btn-gradient-warning btn-rounded editButton" data-credit-card-id="' . $row->id . '" >Edit</a>';  
                            $actions .= '<a class="btn btn-sm btn-gradient-success btn-rounded statusButton" data-credit-card-id="' . $row->id . '" >Status</a>';  
                            $actions .= '<form class="delete-finance-form" data-finance-route="credit-card" data-finance-id="' . $row->id . '">
                                            <button type="button" class="btn btn-sm btn-gradient-danger btn-rounded delete-finance-button">Delete</button>
                                        </form> </div>';
                            return $actions;
                        } else {
                            return '';
                        }
                    })
                    ->rawColumns(['actions'])
                    ->make(true);                                                                                                                                                                                                                                                 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.creditcard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            $referral_id = "ghijk12345";
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
            'status'=>"Initiated"
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

    /**
     * Display the specified resource.
     */
    public function show(string $creditCardId)
    {
        $creditCard = CreditCard::find($creditCardId);
    
        if($creditCard) {
            return response()->json($creditCard);
        } 
        
        return response()->json(['error' => 'Credit Card not found'], 404);
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
    public function update(Request $request, string $creditCardId)
    {
        $formMethod = $request->method();
        if($formMethod == "PATCH"){
            // Find the credit card record by its ID
            $creditCard = CreditCard::findOrFail($creditCardId);

            $validator = Validator::make($request->all(), [
                'status' => 'required|string',
                'application_stage' => 'nullable|string',
                'approval_date' => 'nullable|date',
            ]);

            if($validator->fails()){
                return Response(['message' => $validator->errors()],401);
            } 

            // dd("ok");
        
            // Update the credit card record with the new data
            // $creditCard->update([
            //     'status' => $request->status,
            //     'application_stage' => $request->application_stage,
            //     'approval_date' => $request->approval_date,
            // ]);
            $isUpdated=$creditCard->update($request->all());
            if($isUpdated){
                return Response(['message' => "Credit Card updated successfully"],200);
            }
            return Response(['message' => "Something went wrong"],500);
        }
        return Response(['message'=>"Invalid form method "],405);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $creditCard = CreditCard::find($id);

        if (!$creditCard) {
            return Response(['status' => false, 'message' => "Credit Card not found"], 404);
        }

         $isDeleted = $creditCard->delete();

        if ($isDeleted) {
            return Response(['status' => true, 'message' => "Credit Card form deleted successfully"], 200);
        }

        return Response(['status' => false, 'message' => "Something went wrong"], 500);
    }

    public function updateStatus(Request $request, string $creditCardId)
    {
        $formMethod = $request->method();
        if($formMethod == "PATCH"){
            // Find the credit card record by its ID
            $creditCard = CreditCard::findOrFail($creditCardId);

            $validator = Validator::make($request->all(), [
                'status' => 'required|string',
                'application_stage' => 'nullable|string',
                'approval_date' => 'nullable|date',
                'remark' => 'nullable|string'
            ]);

            if($validator->fails()){
                return Response(['message' => $validator->errors()],401);
            } 
            $isUpdated=$creditCard->update($request->all());
            if($isUpdated){
                return Response(['message' => "Credit Card updated successfully"],200);
            }
            return Response(['message' => "Something went wrong"],500);
        }
        return Response(['message'=>"Invalid form method "],405);
    }
}
