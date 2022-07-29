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

        $user = Subscription::all();

        // if(empty($user)){
        //     return response(['message' => 'Access Failed #USER_GET_ERR02', 'success' => false], 422);
        // }

        // //role and permissions 被 laravel 用左
        // $user['currentrole'] = $user->roles()->first();
        // $haspermissions = User::getAllPermissionsAttribute($user);
        // $user['haspermissions'] = $haspermissions;
//        $user->getAllPermissions();



        return response(['result' => $user, 'success' => true], 200);
    }

    //only get login 中 的 user
    public function me(Request $request)
    {
        //guard name is adminapi
        $user = auth()->user();
//        dd(auth('')->user());

        $haspermissions = User::getAllPermissionsAttribute($user);
        $user['role'] = $user->roles()->first();
        $user['haspermissions'] = $haspermissions;

        return response(['result' => $user, 'success' => true], 200);
    }

    public function roleList(){
        if(auth()->user()->isadmin){
            $roles = Role::select('name','id')->get()->all();
        }else{
            $roles = Role::select('name','id')->where('cancreate', 1)->get()->all();
        }

        if(!empty($roles)){
            $temp = [];
            foreach ($roles as $role){
                $temp[] = [
                    'label' => $role['name'],
                    'value' => $role['id']
                ];
            }
            $roles = $temp;
        }

        $permissionsByRole = Role::query()
            ->with(['permissions' => function ($query) {
                $query->select('id', 'name', 'description');
            }])
            ->get()
            ->pluck('permissions', 'id')
            ->all();

        $permissions = Permission::query()->pluck('name', 'id')->all();

        return response(['result' => [
            'roles' => $roles,
            'permissionsByRole' => $permissionsByRole,
            'permissions' => $permissions,
        ], 'success' => true], 200);
    }

    //show role detail
    public function role_show(Request $request)
    {
        $id = $request->get('id');
        if(!$id){
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
        $role = Role::find($id);

        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_id", $id)
            ->get();

        $permissions = Permission::all();

        return response(['result' => [
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions,
        ], 'success' => true], 200);
    }

    public function role_update(Request $request){
        $id = $request->get('id');
        if(!$id){
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $role = Role::find($id);
        $permissions = $request->input('permissions');
        //view scope
//        if($request->get('view_scope', '') == 'team'){
//            $permissions[] = 'scope team';
//        }

        $role->syncPermissions($permissions);


        return response(['result' => [], 'success' => true], 200);
    }
}

