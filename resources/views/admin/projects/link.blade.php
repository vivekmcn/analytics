@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Link Project</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Customers</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers.view',['id' => $customer_id]) }}">View</a></li>
                  <li class="breadcrumb-item active">Link Project</li>
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
                      <h3 class="card-title">Link New Project</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('admin.projects.linkact') }}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="customer_id" value="{{ $customer_id }}" />
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Project</label>
                          <div class="col-sm-10">
                              <select name="project_id" id="project_id" class="form-control">
                                  <option value="">Select</option>
                                  @foreach($projects as $id => $name)
                                  <option value="{{ $id }}">{{ $name }}</option>
                                  @endforeach
                              </select>
                           @error('project_id')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        
                        

                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-info">Create</button>
                        <a class="btn btn-default float-right" href="{{ route('admin.customers') }}">Cancel</a>
                      </div>
                      <!-- /.card-footer -->
                    </form>
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