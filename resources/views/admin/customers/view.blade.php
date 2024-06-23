@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>User Details</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Users</a></li>
                  <li class="breadcrumb-item active">User Details</li>
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
                      <h3 class="card-title">User Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th>Name</th>
                            <td>{{ $customer->user->name }}</td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td>{{ $customer->user->email }}</td>
                          </tr>
                          <tr>
                            <th>Phone</th>
                            <td>{{ $customer->phone }}</td>
                          </tr>
                          <tr>
                            <th>Address</th>
                            <td>{!! nl2br($customer->address) !!}</td>
                          </tr>
                        </tbody>
                      </table>  
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <a class="btn btn-default float-right" href="{{ route('admin.customers') }}">Back</a>
                    </div>
                      
                  </div>
                  <!-- /.card -->
              </div>
              <div class="col-6">
                <div class="card card-info">
                    <div class="card-header d-flex p-0">
                      <h3 class="card-title">Projects</h3>
                      <ul class="nav nav-pills ml-auto p-2">
                          <li class="nav-item">
                          <a href="{{ route('admin.projects.link',['customer_id' => $customer->id]) }}" class="nav-link active">Link Project</a>
                        </li>
                        <li class="nav-item" style="margin-left: 10px">
                          <a href="{{ route('admin.projects.add',['id' => $customer->id]) }}" class="nav-link active">Create</a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @if(count($projects) > 0)
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($projects as $key => $project)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->status==1?"Active":"Inactive" }}</td>
                            <td>
                              <a class="edit btn btn-info" href="{{ route('admin.projects.view',['id' => $project->id]) }}"><i class="fa fa-eye"></i></a> 
                              <a class="edit btn btn-info" href="{{ route('admin.projects.edit',['id' => $project->id]) }}"><i class="fa fa-edit"></i></a> 
                              <a class="edit btn btn-danger" onclick="return confirm('Are you sure to delete this project? ')" href="{{ route('admin.projects.delete',['id' => $project->id,'customer_id' => $customer->id]) }}"><i class="fa fa-trash"></i></a> 
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @else
                      <p>No projects added yet</p>
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