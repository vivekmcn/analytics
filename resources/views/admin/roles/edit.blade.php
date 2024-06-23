@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Role</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.roles') }}">Roles</a></li>
                  <li class="breadcrumb-item active">Edit Role</li>
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
                      <h3 class="card-title">Edit Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('admin.roles.update') }}">
                      @csrf
                      <input type="hidden" name="id" value="{{ $role->id }}" />
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name')?old('name'):$role->name }}" name="name">
                           @error('name')
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
                                <input type="radio" name="status" value="1" class="form-check-input" {{ $role->status==1?"checked":"" }} />
                                <label class="form-check-label">Active</label>
                              </div>
                              <div class="form-check">
                                <input type="radio" name="status" value="0" class="form-check-input" {{ $role->status==0?"checked":"" }} />
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
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                        <a class="btn btn-default float-right" href="{{ route('admin.roles') }}">Cancel</a>
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