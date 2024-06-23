<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Customers\CreateRequest;
use App\Http\Requests\Admin\Customers\UpdateRequest;
use App\Models\CustomerProject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UsersRole;
use App\Models\Customer;
use App\Models\Project;
use App\Models\User;

class CustomersController extends Controller
{
    public function index()
    {
    	return view('admin/customers/index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
       
        $users = Customer::with('user');
        $result['count'] = $users->count();
        $data 	=	$users->limit($limit)->offset($offset)->get()->toArray();
        $result['data']  = $data;
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	return view('admin.customers.add');
    }

    public function create(CreateRequest $request)
    {
    	$user 						=	new User();
    	$user->name 				=	$request->name;
    	$user->email 				=	$request->email;
    	$user->password 			=	Hash::make($request->password);
    	if($user->save())
    	{
    		$customerobj 			=	new Customer();
    		$customerobj->user_id	=	$user->id;
    		$customerobj->address 	=	$request->address;
    		$customerobj->phone  	=	$request->phone;
    		$customerobj->save();

    		$userrole 	=	new UsersRole();
    		$userrole->user_id = $user->id;
    		$userrole->role_id = 5;
    		$userrole->save();

    		return redirect()->route('admin.customers')->with('success', 'Customer created successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }

    public function view($id)
    {
    	$customer 			=	Customer::with('user')->where('id', $id)->first();
    	$customerprojects   =   CustomerProject::where('customer_id', $customer->id)->pluck('project_id' ,'id')->toArray();
    	$projects    		=	Project::whereIn('id', $customerprojects)->get();
    	return view('admin/customers/view')->with(compact('customer','projects'));
    }

    public function edit($id)
    {
    	$customer 			=	Customer::with('user')->where('id', $id)->first();
    	return view('admin/customers/edit')->with(compact('customer'));	
    }

    public function update(UpdateRequest $request)
    {
    	\DB::beginTransaction();
    	try{
	    	$user 				=	User::where('id', $request->user_id)->first();
	    	$user->name 		=	$request->name;
	    	$user->email 		=	$request->email;
	    	$user->save();

	    	$customer 			=	Customer::where('id', $request->id)->first();
	    	$customer->phone 	=	$request->phone;
	    	$customer->address 	=	$request->address;
	    	$customer->save();
	    	\DB::commit();
	    	return redirect()->route('admin.customers')->with('success', 'Customer updated successfully.');
	    }catch(Exception $e){
	    	\DB::rollback();
	    	return redirect()->back()->with('warning', 'Something went wrong.');
	    }
    }

    public function delete($id)
    {
    	\DB::beginTransaction();
    	try{
    		$customer 	=	Customer::where('id', $id)->first();
    		Customer::where('id', $id)->delete();
    		User::where('id', $customer->user_id)->delete();
	    	\DB::commit();
	    	return redirect()->route('admin.customers')->with('success', 'Customer deleted successfully.');
    	}catch(Exception $e){
	    	\DB::rollback();
	    	return redirect()->back()->with('warning', 'Something went wrong.');
	    }
    }
}
