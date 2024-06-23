@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Permissions</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.permissions') }}">Permissions</a></li>
                  <li class="breadcrumb-item active">Edit</li>
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
                      <h3 class="card-title">Edit Permission</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('admin.permissions.update') }}">
                      @csrf
                      <input type="hidden" name="id" value="{{ $permission->id }}">
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Controller</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="controller" placeholder="Controller" value="{{ old('controller')?old('controller'):$permission->controller }}" name="controller">
                           @error('controller')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Action</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="action" placeholder="Action" value="{{ old('action')?old('action'):$permission->action }}" name="action">
                           @error('action')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="action" placeholder="Name" value="{{ old('name')?old('name'):$permission->name }}" name="name">
                           @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                        <a class="btn btn-default float-right" href="{{ route('admin.permissions') }}">Cancel</a>
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