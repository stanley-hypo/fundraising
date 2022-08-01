<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DonationController extends Controller
{

    public function showMonthly(Request $request)
    {
        $subscription = Subscription::all();

        return response(['result' => $subscription, 'success' => true], 200);
    }

    public function getMonthlyDetail(Request $request)
    {
        $id = $request->get('id');
         
        if(!$id){
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
        $subscription = Subscription::find($id);

        return response(['result' => $subscription, 'success' => true], 200);
    }

    public function updateMonthlyDetail(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => 'required|max:100',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response([ 'success' => false, 'message' => 'Validate Failed #SUBSCRIPTION_EDIT_ERR01' ], 422);
        }

        $input['email'] = strtolower($input['email']);

        DB::transaction(function () use($input, $request, &$subscription){
            $subscription = Subcription::find($input['id']);

            $subscription->update($input);

        });

        return response([ 'success' => true, 'message' => 'Add User Success!', 'user_id'=>$user->id ], 200);
    }
    
}

