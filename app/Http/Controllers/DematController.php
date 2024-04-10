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
use App\Models\Loan;
use App\Models\Demat;

class DematController extends Controller
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
            $users = Demat::with('dematRefer')->orderBy('id', 'desc')->get();
            
            if ($users) {
                return view('dashboard.services.demat-list');
            }
        }
        return Response(['data' => 'Unauthorized'], 401);
    }

    public function getDematTableData(Request $request)
    {
        $data =Demat::with('dematRefer')
                ->when(request()->has('search'), function ($query) {
                    $search = request('search');
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhere('application_stage', 'like', '%' . $search . '%')
                        ->orWhere('approval_date', 'like', '%' . $search . '%')
                        ->orWhereHas('dematRefer', function ($q) use ($search) {
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
                            ->orWhereHas('dematRefer', function ($q) use ($logged_user_referral_id) {
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
                        // Check if user has Superadmin or Admin role
                        if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin')) {
                            $actions = '<a class="btn btn-sm btn-gradient-warning btn-rounded viewButton" data-demat-id="' . $row->id . '" >View</a>';  
                            // $actions .= '<a class="btn btn-sm btn-gradient-warning btn-rounded editButton" data-demat-id="' . $row->id . '" >Edit</a>';  
                            $actions .= '<a class="btn btn-sm btn-gradient-warning btn-rounded statusButton" data-demat-id="' . $row->id . '" >Status</a>';  
                            $actions .= '<form class="delete-demat-form" data-demat-id="' . $row->id . '">
                                            <button type="button" class="btn btn-sm btn-gradient-danger btn-rounded delete-user-button">Delete</button>
                                        </form>';
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
        return view('frontend.demat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            $referral_id = "ghijk12345";
        }

        $demat = Demat::create([
            'referred_by'=>$referral_id,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'pan_num' => $request->pan_num,
            'adhar_num' => $request->adhar_num,
            'status'=>'Initiated'
        ]);

        if ($demat) {     
            return Response(['status' => true, 'message' => "Demat submitted successfully !"], 200);
        }

        return Response(['status' => false, 'message' => "Something went wrong"], 500);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $demat = Demat::find($id);
    
        if($demat) {
            return response()->json($demat);

        } else {
            return response()->json(['error' => 'Demat not found'], 404);
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
        $formMethod = $request->method();
        if($formMethod == "PATCH"){
            // Find the demat record by its ID
            $demat = Demat::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:10',
                'pan_num' => ['required', 'string', 'max:10', 'regex:/^[A-Z]{5}\d{4}[A-Z]$/'],
                'adhar_num' => ['required', 'string', 'max:12', 'regex:/^\d{12}$/'],
            ]);

            if($validator->fails()){
                return Response(['message' => $validator->errors()],401);
            } 

            $isUpdated=$demat->update($request->all());

            if($isUpdated){
                return Response(['message' => "Demat updated successfully"],200);
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
        $demat = Demat::find($id);

        if (!$demat) {
            return Response(['status' => false, 'message' => "Demat not found"], 404);
        }

         $isDeleted = $demat->delete();

        if ($isDeleted) {
            return Response(['status' => true, 'message' => "Demat form deleted successfully"], 200);
        }

        return Response(['status' => false, 'message' => "Something went wrong"], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        $formMethod = $request->method();
        if($formMethod == "PATCH"){
            // Find the demat record by its ID
            $demat = Demat::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'status' => 'required|string',
                'application_stage' => 'nullable|string',
                'approval_date' => 'nullable|date',
                'remark' => 'nullable|string'
            ]);

            if($validator->fails()){
                return Response(['message' => $validator->errors()],401);
            } 

            $isUpdated=$demat->update($request->all());
            if($isUpdated){
                return Response(['message' => "Demat updated successfully"],200);
            }
            return Response(['message' => "Something went wrong"],500);
        }
        return Response(['message'=>"Invalid form method "],405);
    }
}
