<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UsersRole;
use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
    	return view('admin/users/index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $roles = Role::pluck('name', 'id');
        $users = User::orderBy('id', 'asc');
        $result['count'] = $users->count();
        $data 	=	$users->limit($limit)->offset($offset)->get()->toArray();
        foreach ($data as $key => $user) {
        	$userrole 	=	UsersRole::where('user_id', $user['id'])->first();
        	$data[$key]['role'] = $roles[$userrole->role_id];
        }
        $result['data']  = $data;
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	$roles = Role::pluck('name', 'id');
    	return view('admin/users/add')->with(compact('roles'));
    }

    public function create(CreateRequest $request)
    {
    	$user 			=	new User();
    	$user->name 	=	$request->name;
    	$user->email 	=	$request->email;
    	$user->password =	Hash::make($request->password);
    	if($user->save())
    	{
    		$userrole 	=	new UsersRole();
    		$userrole->user_id = $user->id;
    		$userrole->role_id = $request->role_id;
    		$userrole->save();
    		return redirect()->route('admin.users')->with('success', 'User created successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }

    public function view($id)
    {
    	$roles = Role::pluck('name', 'id');
    	$user 	=	User::where('id', $id)->first();
    	$userrole =	UsersRole::where("user_id", $id)->first();
    	return view('admin/users/view')->with(compact('roles','user','userrole'));
    }

    public function edit($id)
    {
    	$roles = Role::pluck('name', 'id');
    	$user 	=	User::where('id', $id)->first();
    	$userrole =	UsersRole::where("user_id", $id)->first();
    	return view('admin/users/edit')->with(compact('roles','user','userrole'));
    }

    public function update(UpdateRequest $request)
    {
    	$user 					=	User::where('id', $request->id)->first();
    	$user->name 			=	$request->name;
    	$user->email 			=	$request->email;
    	if($user->save())
    	{
    		UsersRole::where('user_id', $request->id)->delete();
    		$userrole 	=	new UsersRole();
    		$userrole->user_id = $user->id;
    		$userrole->role_id = $request->role_id;
    		$userrole->save();
    		return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }

    public function delete($id)
    {
    	if(User::where('id', $id)->delete()){
    		UsersRole::where('user_id', $id)->delete();
    		return redirect()->back()->with('success', 'User deleted successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }
}
