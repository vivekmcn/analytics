@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>View Credentials</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Customers</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers.view',['id' => $project->customer_id]) }}">Customer View</a></li>
                  <li class="breadcrumb-item active"><a href="{{ route('admin.projects.view',['id' => $project->id]) }}">Project View</a></li>
                  <li class="breadcrumb-item active">View Credential</li>
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
                      <h3 class="card-title">Credential Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th>Credential Type</th>
                            <td>{{ $credential->credentialtype->name }}</td>
                          </tr>
                          <tr>
                            <th>Credential</th>
                            <td>{{ $credential->credential }}</td>
                          </tr>
                          <tr>
                            <th>Key</th>
                            <td>{{ $credential->cred_key }}</td>
                          </tr>
                          <tr>
                            <th>Status</th>
                            <td>{{ $credential->status==1?"Active":"Inactive" }}</td>
                          </tr>
                        </tbody>
                      </table>  
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <a class="btn btn-default float-right" href="{{ route('admin.projects.view',['id' => $project->id]) }}">Back</a>
                    </div>
                    
                  </div>
                  <!-- /.card -->
              </div>
            </div>
          </div>
        </section>
      </div>
  </div>
  <!-- /.content-wrapper -->
  @endsection