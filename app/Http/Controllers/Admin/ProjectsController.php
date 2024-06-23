<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Projects\CreateRequest;
use App\Http\Requests\Admin\Projects\UpdateRequest;
use App\Http\Requests\Admin\Projects\LinkprojectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Credential;
use App\Models\CustomerProject;

class ProjectsController extends Controller
{
    public function add($id)
    {
    	return view('admin/projects/add')->with(compact('id'));
    }

    public function create(CreateRequest $request)
    {
    	$project 				=	new Project();

        if($request->logo){
            $rand = mt_rand(100000, 999999);
            $name = time() . "_"  . $rand . "." . $request->logo->getClientOriginalExtension();
            if(!file_exists(public_path() . '/logo/'))
            {
                mkdir(public_path() . '/logo/');
            }
            $request->logo->move(public_path() . '/logo/', $name);
        }else{
            $name               =   "";
        }
    	$project->name 			=	$request->name;
        $project->logo          =   $name;
    	$project->customer_id 	=	$request->customer_id;
    	if($request->ga4_enabled){
    	    $project->is_ga4    =   1;
    	    $project->property_id=  $request->property_id;
    	}else{
    	    $project->is_ga4    =   0; 
    	}
    	
    	$project->status 		=	$request->status;
    	if($project->save()){
    	    $customerproject                = new CustomerProject();
            $customerproject->customer_id   = $request->customer_id;
            $customerproject->project_id    = $project->id;
            $customerproject->status        =   1;
            $customerproject->save();
    		return redirect()->route('admin.customers.view',['id' => $request->customer_id])->with('success', 'Project created successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }

    public function view($id)
    {
    	$project 				=	Project::where('id', $id)->first();
    	$credentials 			=	Credential::with('credentialtype')->where('project_id', $id)->get();
    	return view('admin/projects/view')->with(compact('project','credentials'));
    }

    public function edit($id)
    {
    	$project 				=	Project::where('id', $id)->first();
    	return view('admin/projects/edit')->with(compact('project'));	
    }

    public function update(UpdateRequest $request)
    {
    	$project 				=	Project::where('id', $request->id)->first();
    	$project->name 			=	$request->name;
    	if($request->ga4_enabled){
    	    $project->is_ga4    =   1;
    	    $project->property_id=  $request->property_id;
    	}else{
    	    $project->is_ga4    =   0; 
    	}
    	$project->status 		=	$request->status;
        if($request->logo){
            $rand = mt_rand(100000, 999999);
            $name = time() . "_"  . $rand . "." . $request->logo->getClientOriginalExtension();
            if(!file_exists(public_path() . '/logo/'))
            {
                mkdir(public_path() . '/logo/');
            }
            $request->logo->move(public_path() . '/logo/', $name);
            $project->logo      =   $name;
        }
    	if($project->save()){
    		return redirect()->route('admin.customers.view',['id' => $project->customer_id])->with('success', 'Project updated successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}	
    }

    public function delete($id, $customer_id)
    {
    	\DB::beginTransaction();
    	try{
    		$project 			=	CustomerProject::where('project_id', $id)->where('customer_id', $customer_id)->first();
    		if($project){
    		    CustomerProject::where('id', $project->id)->delete();
	    	    \DB::commit();
	    	    return redirect()->route('admin.customers.view',['id' => $project->customer_id])->with('success', 'Project deleted successfully.');
    		}else{
    		    return redirect()->back()->with('warning', 'Something went wrong.');
    		}
    	}catch(Exception $e){
	    	\DB::rollback();
	    	return redirect()->back()->with('warning', 'Something went wrong.');
	    }
    }
    
    
    public function linkProject($customer_id){
        $customerprojects = CustomerProject::where('customer_id', $customer_id)->pluck('project_id' ,'id')->toArray();
        $projects           =   Project::whereNotIn('id', $customerprojects)->pluck('name', 'id')->toArray();
        return view('admin/projects/link')->with(compact('projects','customer_id'));
    }
    
    public function linkToCustomer(LinkprojectRequest $request)
    {
        $customerproject                = new CustomerProject();
        $customerproject->customer_id   = $request->customer_id;
        $customerproject->project_id    = $request->project_id;
        $customerproject->status        =   1;
        if($customerproject->save()){
    		return redirect()->route('admin.customers.view',['id' => $request->customer_id])->with('success', 'Project updated successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }
}
