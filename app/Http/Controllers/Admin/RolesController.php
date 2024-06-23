<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Roles\CreateRequest;
use App\Http\Requests\Admin\Roles\UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
    	return view('admin/roles/index');
    }

    public function paginate(){
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $roles = Role::orderBy('id', 'asc');
        $result['count'] = $roles->count();
        $result['data']  = $roles->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	return view('admin.roles.add');
    }

    public function create(CreateRequest $request)
    {
    	$role 			=	new Role();
    	$role->name 	=	$request->name;
    	$role->slug 	=	self::slugify($request->name);
    	$role->status 	=	$request->status;
    	if($role->save()){
    		return redirect()->route('admin.roles')->with('success', 'Role created successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }

    public function view($id)
    {
    	$role 			=	Role::where('id', $id)->first();
    	return view('admin.roles.view')->with(compact('role'));
    }

    public function edit($id)
    {
    	$role 			=	Role::where('id', $id)->first();
    	return view('admin.roles.edit')->with(compact('role'));
    }

    public function update(UpdateRequest $request)
    {
    	$role 			=	Role::where('id', $request->id)->first();
    	$role->name 	=	$request->name;
    	$role->slug 	=	self::slugify($request->name);
    	$role->status 	=	$request->status;
    	if($role->save()){
    		return redirect()->route('admin.roles')->with('success', 'Role updated successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}	
    }

    public function delete($id)
    {
    	if(Role::where('id', $id)->delete()){
    		return redirect()->back()->with('success', 'Role deleted successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }
}
