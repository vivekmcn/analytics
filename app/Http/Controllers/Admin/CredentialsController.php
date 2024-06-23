<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Credentials\AddRequest;
use App\Http\Requests\Admin\Credentials\EditRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CredentialType;
use App\Models\Project;
use App\Models\Credential;

class CredentialsController extends Controller
{
    public function add($id)
    {
    	$types 				=	CredentialType::pluck('name', 'id')->toArray();
    	$project 			=	Project::where('id', $id)->first();
    	return view('admin.credentials.add')->with(compact('project', 'types'));
    }

    public function create(AddRequest $request)
    {
    	$credential 						=	new Credential();
    	$credential->credential_type_id 	=	$request->credential_type_id;
    	$credential->credential 			=	$request->credential;
    	$credential->project_id 			=	$request->project_id;
    	$credential->cred_key 				=	$request->cred_key;
    	$credential->status 				=	$request->status;
    	if($credential->save())
    	{
			return redirect()->route('admin.projects.view',['id' => $request->project_id])->with('success', 'Credential saved successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}
    }

    public function view($id)
    {
    	$credential 		=	Credential::with('credentialtype')->where('id', $id)->first();
    	$project 			=	Project::where('id', $credential->project_id)->first();
    	return view('admin.credentials.view')->with(compact('project', 'credential'));	
    }

    public function edit($id)
    {
    	$types 				=	CredentialType::pluck('name', 'id')->toArray();
    	$credential 		=	Credential::where('id', $id)->first();
    	$project 			=	Project::where('id', $credential->project_id)->first();
    	return view('admin.credentials.edit')->with(compact('types', 'credential', 'project'));	
    }

    public function update(EditRequest $request)
    {
    	$credential 						=	Credential::where('id', $request->id)->first();
    	$credential->credential_type_id 	=	$request->credential_type_id;
    	$credential->credential 			=	$request->credential;
    	$credential->cred_key 				=	$request->cred_key;
    	$credential->status 				=	$request->status;
    	if($credential->save())
    	{
			return redirect()->route('admin.projects.view',['id' => $credential->project_id])->with('success', 'Credential updated successfully.');
    	}else{
    		return redirect()->back()->with('warning', 'Something went wrong.');
    	}	
    }

    public function delete($id)
    {
    	\DB::beginTransaction();
    	try{
    		$credential 			=	Credential::where('id', $id)->first();
    		Credential::where('id', $id)->delete();
	    	\DB::commit();
	    	return redirect()->route('admin.projects.view',['id' => $credential->project_id])->with('success', 'Credential deleted successfully.');
    	}catch(Exception $e){
	    	\DB::rollback();
	    	return redirect()->back()->with('warning', 'Something went wrong.');
	    }
    }

}
