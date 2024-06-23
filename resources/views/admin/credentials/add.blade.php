@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add Credentials</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Customers</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers.view',['id' => $project->customer_id]) }}">Customer View</a></li>
                  <li class="breadcrumb-item active"><a href="{{ route('admin.projects.view',['id' => $project->id]) }}">Project View</a></li>
                  <li class="breadcrumb-item active">Add Credential</li>
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
                      <h3 class="card-title">Add Credential</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('admin.credentials.create') }}">
                      @csrf
                      <input type="hidden" name="project_id" value="{{ $project->id }}" />
                      <div class="card-body">
                        
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Credential Type</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="credential_type_id">
                              <option value="">Select</option>
                              @foreach($types as $typeid => $type)
                              <option value="{{ $typeid }}">{{ $type }}</option>
                              @endforeach
                            </select>
                              
                           @error('credential_type_id')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Credential</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="credential" placeholder="Credential" value="{{ old('credential') }}" name="credential">
                           @error('credential')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Credential Key</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="cred_key" placeholder="Credential Key" value="{{ old('cred_key') }}" name="cred_key">
                           @error('cred_key')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-10">
                            <div class="form-group">
                              <div class="form-check">
                                <input type="radio" name="status" value="1" class="form-check-input" />
                                <label class="form-check-label">Active</label>
                              </div>
                              <div class="form-check">
                                <input type="radio" name="status" value="0" class="form-check-input" />
                                <label class="form-check-label">Inactive</label>
                              </div>
                            </div>
                           @error('status')
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
                        <a class="btn btn-default float-right" href="{{ route('admin.projects.view',['id' => $project->id]) }}">Cancel</a>
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