@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Project Details</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Users</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers.view',['id' => $project->customer_id]) }}">User Details</a></li>
                  <li class="breadcrumb-item active">Project Details</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-6">
                <!-- Horizontal Form -->
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Project Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th>Name</th>
                            <td>{{ $project->name }}</td>
                          </tr>
                          <tr>
                            <th>Logo</th>
                            <td>
                              @if(!empty($project->logo))
                                <img style="max-width:100%;max-height:50px" src="{{ asset('/logo/'.$project->logo) }}" />
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <th>Status</th>
                            <td>{{ ($project->status==1)?"Active":"Inactive" }}</td>
                          </tr>
                        </tbody>
                      </table>  
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <a class="btn btn-default float-right" href="{{ route('admin.customers.view',['id' => $project->customer_id]) }}">Back</a>
                    </div>
                      
                  </div>
                  <!-- /.card -->
              </div>
              <div class="col-6">
                <div class="card card-info">
                    <div class="card-header d-flex p-0">
                      <h3 class="card-title">Credentials</h3>
                      <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item">
                          <a href="{{ route('admin.credentials.add',['id' => $project->id]) }}" class="nav-link active">Create</a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @if(count($credentials) > 0)
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($credentials as $key => $credential)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $credential->credentialtype->name }}</td>
                            <td>{{ $credential->status==1?"Active":"Inactive" }}</td>
                            <td>
                              <a class="edit btn btn-info" href="{{ route('admin.credentials.view',['id' => $credential->id]) }}"><i class="fa fa-eye"></i></a> 
                              <a class="edit btn btn-info" href="{{ route('admin.credentials.edit',['id' => $credential->id]) }}"><i class="fa fa-edit"></i></a> 
                              <a class="edit btn btn-danger" onclick="return confirm('Are you sure to delete this credential? ')" href="{{ route('admin.credentials.delete',['id' => $credential->id]) }}"><i class="fa fa-trash"></i></a> 
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @else
                      <p>No credentials added yet</p>
                      @endif
                    </div>
                    <div class="card-footer"></div>
                  </div>
              </div>
            </div>
          </div>
        </section>
  </div>
  <!-- /.content-wrapper -->
  @endsection