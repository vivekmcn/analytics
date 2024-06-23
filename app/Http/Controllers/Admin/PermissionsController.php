<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Permissions\CreateRequest;
use App\Http\Requests\Admin\Permissions\UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
    	return view('admin.permissions.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $permission = Permission::orderBy('id', 'asc');
        $result['count'] = $permission->count();
        $result['data']  = $permission->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	return view('admin.permissions.add');
    }

    public function create(CreateRequest $request)
    {
    	$permission 						=	new Permission();
    	$permission->name 					=	$request->name;
    	$permission->controller 			=	$request->controller;
    	$permission->action 				=	$request->action;
    	$permission->slug 					=	Self::slugify($request->name);
    	if($permission->save()){
    		return redirect()->route('admin.permissions')->with('success', 'Permission created successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }

    public function view($id)
    {
    	$permission 			=	Permission::where('id', $id)->first();
    	return view('admin.permissions.view')->with(compact('permission'));
    }

    public function edit($id)
    {
    	$permission 			=	Permission::where('id', $id)->first();
    	return view('admin.permissions.edit')->with(compact('permission'));	
    }

    public function update(UpdateRequest $request)
    {
    	$permission 						=	Permission::where('id', $request->id)->first();
    	$permission->name 					=	$request->name;
    	$permission->controller 			=	$request->controller;
    	$permission->action 				=	$request->action;
    	$permission->slug 					=	Self::slugify($request->name);
    	if($permission->save()){
    		return redirect()->route('admin.permissions')->with('success', 'Permission updated successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}	
    }

    public function delete($id)
    {
    	if(Permission::where('id', $id)->delete()){
    		return redirect()->back()->with('success', 'Permission deleted successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }
}
