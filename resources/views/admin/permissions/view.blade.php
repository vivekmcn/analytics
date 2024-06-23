@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Permission Details</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.permissions') }}">Permissions</a></li>
                  <li class="breadcrumb-item active">Permission Details</li>
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
                      <h3 class="card-title">Permission Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th>Name</th>
                            <td>{{ $permission->name }}</td>
                          </tr>
                          <tr>
                            <th>Controller</th>
                            <td>{{ $permission->controller }}</td>
                          </tr>
                          <tr>
                            <th>Action</th>
                            <td>{{ $permission->action }}</td>
                          </tr>
                        </tbody>
                      </table>  
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <a class="btn btn-default float-right" href="{{ route('admin.permissions') }}">Back</a>
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