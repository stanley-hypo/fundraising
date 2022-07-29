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
        // dd($request->all());
        // $data = $request->all();

        // if(empty($data['id'])){
        //     return response(['message' => 'Empty Id #USER_GET_ERR01', 'success' => false], 422);
        // }

        $subscription = Subscription::all();

        // if(empty($user)){
        //     return response(['message' => 'Access Failed #USER_GET_ERR02', 'success' => false], 422);
        // }

        // //role and permissions 被 laravel 用左
        // $user['currentrole'] = $user->roles()->first();
        // $haspermissions = User::getAllPermissionsAttribute($user);
        // $user['haspermissions'] = $haspermissions;
//        $user->getAllPermissions();



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

    
}

