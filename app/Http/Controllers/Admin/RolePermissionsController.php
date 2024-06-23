<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RolesPermission;
use App\Models\Role;

class RolePermissionsController extends Controller
{
    public function index(){
    	$roles 		=		Role::pluck('name', 'id')->toArray();
    	return view('admin.rolepermissions.index')->with(compact('roles'));
    }

    public function get($id)
    {
    	$data = \DB::table('permissions')
    	->leftJoin('roles_permissions', function($join) use($id){
    		$join->on('permissions.id', '=', 'roles_permissions.permission_id');
    		$join->on('roles_permissions.role_id', '=', \DB::raw($id));
    	})->select('permissions.id', 'permissions.controller', 'permissions.name', 'roles_permissions.role_id')
        ->get();
        $permissions = [];
        foreach ($data as $key => $row) {
        	$permissions[$row->controller][] = $row;
        }
        return view('admin.rolepermissions.list')->with(compact('permissions','id'));
    }

    public function update(Request $request)
    {
    	\DB::beginTransaction();
    	try{
	    	if(isset($request->role_id))
	    	{
	    		RolesPermission::where('role_id', $request->role_id)->delete();
	    		foreach ($request->permission_id as $key => $permission_id) {
	    			$rolepermission 				=		new RolesPermission();
	    			$rolepermission->role_id 		=		$request->role_id;
	    			$rolepermission->permission_id 	=		$permission_id;
	    			$rolepermission->save();
	    		}
	    		\DB::commit();
	    		return ['status' => 1];
	    	}
	    }catch(Exception $e){
	    	\DB::rollback();
	    	return ['status' => 0];
	    }
    }
}
