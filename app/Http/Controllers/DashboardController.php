<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\CreditCard;
use App\Models\Loan;
use App\Models\Demat;
use App\Models\Insurance;

class DashboardController extends Controller
{
    function dashboard()
    {
        $creditCardCount = $this->getCount(CreditCard::class,'creditCardRefer');
        $loanCount = $this->getCount(Loan::class,'loanRefer');
        $dematCount = $this->getCount(Demat::class,'dematRefer');


        if(Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin')){
            $insuraceCount = Insurance::count();
        }else{
            $logged_user_referral_id=auth()->user()->referral_id;
            $insuraceCount = Insurance::where('referral_id',$logged_user_referral_id)->count();
        }

        return view('dashboard.dashboard.dashboard', [
            'creditCardCount' => $creditCardCount,
            'loanCount' => $loanCount,
            'dematCount' => $dematCount,
            'insuraceCount' => $insuraceCount,
        ]);
    }

    public function getCount($model, $relation)
    {
        $query = $model::query();
    
        // If the user is not an admin or superadmin, apply the referral ID filter
        if (!Auth::user()->hasRole('Admin') && !Auth::user()->hasRole('Superadmin')) {
            $logged_user_referral_id = auth()->user()->referral_id;
            $referralColumn = $model === Loan::class ? 'referred_by' : ($model === CreditCard::class ? 'referred_by' : 'referred_by');
            $query->where(function ($q) use ($logged_user_referral_id, $referralColumn, $relation) {
                $q->where($referralColumn, $logged_user_referral_id)
                  ->orWhereHas($relation, function ($q) use ($logged_user_referral_id, $referralColumn) {
                      $q->where($referralColumn, $logged_user_referral_id);
                  });
            });
        }
    
        // Finally, get the count of the filtered records
        $count = $query->count();
    
        return $count;
    }

}
