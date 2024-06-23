@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Role Details</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.roles') }}">Roles</a></li>
                  <li class="breadcrumb-item active">Role Details</li>
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
                      <h3 class="card-title">Role Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th>Name</th>
                            <td>{{ $role->name }}</td>
                          </tr>
                          <tr>
                            <th>Status</th>
                            <td>{{ $role->status==1?__("Active"):__("Inactive") }}</td>
                          </tr>
                        </tbody>
                      </table>  
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <a class="btn btn-default float-right" href="{{ route('admin.roles') }}">Back</a>
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