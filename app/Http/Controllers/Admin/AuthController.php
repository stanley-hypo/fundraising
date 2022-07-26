<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    public function checkUnique(Request $request): bool
    {
        $allow_fields = [
            'email',
        ];
        $requestData = $request->all();
        if(in_array($requestData['field'], $allow_fields)){
            $whereCond[] = [$requestData['field'], $requestData['value']];
            if(!empty($requestData['recordId'])){
                $whereCond[] = ['id', '!=', $requestData['recordId']];
            }
            return User::where($whereCond)->first() === null;
        }else{
            return false;
        }
    }

    public function list(Request $request){
        $users = User::all();

        $list = [];
        foreach($users as $user){
            $viewUrl = "/admin/user_view/$user->id";
            $editUrl = "/admin/user_edit/$user->id";
            $action = [
                [
                    'container' => 'div',
                    'containerClass' => 'd-inline',
                    'class' => 'btn btn-info btn-sm btn-icon m-1',
                    'innerHTML' => "<i class='fas fa-eye'></i>",
                    'type' => 'button',
                    'url' => $viewUrl,
                ],
                [
                    'container' => 'div',
                    'containerClass' => 'd-inline',
                    'class' => 'btn btn-warning btn-sm btn-icon m-1',
                    'innerHTML' => "<i class='fas fa-edit'></i>",
                    'type' => 'button',
                    'url' => $editUrl,
                ],
            ];

            $list[] = [
                'id'=>$user->id,
                'name'=>$user->name,
                'email'=>$user->email,
                'action'=>$action,
            ];
        }

        return response(['result'=>$list], 200);
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirm',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response([ 'success' => false, 'message' => 'Validate Failed '.$validator->errors() ], 422);
        }

        $input['email'] = strtolower($input['email']);
        $input['password'] = Hash::make($input['password']);

        //direct permission
        if(!empty($input['permissions'])){
            $input['permissions'] = json_decode($input['permissions'], true);
        }

        DB::transaction(function () use($input, $request){
            $input['active'] = ($input['active'] === 1)?1:0;

            $user = User::create($input);
            $user->syncRoles($input['role']);

            if(!empty($input['permissions'])){
                $user->syncPermissions($input['permissions']);
            }
        });

        return response([ 'success' => true, 'message' => 'Add User Success!' ], 200);
    }

    public function updatepwd(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
            'password' => 'required|same:password_confirm',
        ]);

        if ($validator->fails()) {
            return response([ 'success' => false, 'message' => 'Validate Failed #USER_ADD_ERR01' ], 422);
        }

        DB::transaction(function () use($input, $request){
            $user = User::find($input['id']);
            $user->password = Hash::make($request->password);;
            $user->save();
        });

        return response([ 'success' => true, 'message' => 'Password Update!' ], 200);

    }

    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => 'required|max:100',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response([ 'success' => false, 'message' => 'Validate Failed #USER_EDIT_ERR01' ], 422);
        }

        $input['email'] = strtolower($input['email']);

        //other permission
        if(!empty($input['permissions'])){
            $input['permissions'] = json_decode($input['permissions'], true);
        }

        DB::transaction(function () use($input, $request, &$user){
            $user = User::find($input['id']);

            //remove old permission
            $old_permissions = $user->getPermissionNames()->toArray();
            if(!empty($old_permissions)){
                $user->revokePermissionTo($old_permissions);
            }

            $user->update($input);
            $user->syncRoles($input['role']);

            if(!empty($input['permissions'])){
                $user->syncPermissions($input['permissions']);
            }
        });

        return response([ 'success' => true, 'message' => 'Add User Success!', 'user_id'=>$user->id ], 200);
    }

    public function login(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if(! auth('admin')->attempt($requestData)){
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $accessToken =  auth('admin')->user()->createToken('authToken')->accessToken;

        return response(['user' =>  auth('admin')->user(), 'access_token' => $accessToken], 200);
    }

    public function logout (Request $request)
    {
        $token = auth()->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function show(Request $request)
    {
        $data = $request->all();

        if(empty($data['id'])){
            return response(['message' => 'Empty Id #USER_GET_ERR01', 'success' => false], 422);
        }

        $user = User::find($data['id']);

        if(empty($user)){
            return response(['message' => 'Access Failed #USER_GET_ERR02', 'success' => false], 422);
        }

        //role and permissions 被 laravel 用左
        $user['currentrole'] = $user->roles()->first();
        $haspermissions = User::getAllPermissionsAttribute($user);
        $user['haspermissions'] = $haspermissions;
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
