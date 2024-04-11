<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Validator;
use Carbon\Carbon;


use App\Models\Insurance;

class InsuranceController extends Controller
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
            $users = Insurance::orderBy('id', 'desc')->get();
            
            if ($users) {
                return view('dashboard.services.insurance-list');
            }
        }
        return Response(['data' => 'Unauthorized'], 401);
    }

    public function getInsuranceTableData(Request $request)
    {
        $data =Insurance::
                when(request()->has('search'), function ($query) {
                    $search = request('search');
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhere('application_stage', 'like', '%' . $search . '%')
                        ->orWhere('approval_date', 'like', '%' . $search . '%');
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
                    // $query->where(function ($q) use ($logged_user_referral_id) {
                    //     $q->where('referral_id', $logged_user_referral_id);
                    // });
                    $query->where(function ($q) use ($logged_user_referral_id) {
                        $q->where('referral_id', $logged_user_referral_id)
                          ->orWhereIn('referral_id', function ($subquery) use ($logged_user_referral_id) {
                              $subquery->select('referral_id')
                                       ->from('users')
                                       ->where('referred_by', $logged_user_referral_id);
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
                            // $actions = '<a class="btn btn-sm btn-gradient-warning btn-rounded viewButton" data-demat-id="' . $row->id . '" >View</a>';  
                            // $actions .= '<a class="btn btn-sm btn-gradient-warning btn-rounded editButton" data-demat-id="' . $row->id . '" >Edit</a>';  
                            $actions = '<a class="btn btn-sm btn-gradient-warning btn-rounded statusButton" data-insurance-id="' . $row->id . '" >Status</a>';  
                            $actions .= '<form class="delete-demat-form" data-insurance-id="' . $row->id . '">
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get the encrypted data from the request
        $encryptedData = $request->input('ret_data');
        $jsonData = base64_decode($encryptedData);
        $decodedData = json_decode($jsonData, true); 
        // dd($decodedData);

        $name = $decodedData['fname'];
        if (!empty($decodedData['lname'])) {
            $name .= " " . $decodedData['lname'];
        }

        $insurance = Insurance::create([
            'urc' => $decodedData['urc'],
            'umc' => $decodedData['umc'],
            'ak' => $decodedData['ak'],
            'name' => $name,
            'email' => $decodedData['email'],
            'phone' => $decodedData['phno'],
            'referral_id' => $decodedData['pin'],
            'status'=>'Initiated'
        ]);

        if ($insurance) {     
            return Response(['status' => true, 'message' => "Insurance submitted successfully !"], 200);
        }

        return Response(['status' => false, 'message' => "Something went wrong"], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $insurance = Insurance::find($id);
    
        if($insurance) {
            return response()->json($insurance);
    
        }
        return response()->json(['error' => 'Insurance not found'], 404);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $insurance = Insurance::find($id);

        if (!$insurance) {
            return Response(['status' => false, 'message' => "Insurance not found"], 404);
        }

         $isDeleted = $insurance->delete();

        if ($isDeleted) {
            return Response(['status' => true, 'message' => "Insurance form deleted successfully"], 200);
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
            $insurance = Insurance::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'status' => 'required|string',
                'application_stage' => 'nullable|string',
                'approval_date' => 'nullable|date',
                'remark' => 'nullable|string'
            ]);

            if($validator->fails()){
                return Response(['message' => $validator->errors()],401);
            } 

            $isUpdated=$insurance->update($request->all());
            if($isUpdated){
                return Response(['message' => "Insurance updated successfully"],200);
            }
            return Response(['message' => "Something went wrong"],500);
        }
        return Response(['message'=>"Invalid form method "],405);
    }

}
