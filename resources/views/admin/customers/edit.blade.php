@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Customers</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.permissions') }}">Customers</a></li>
                  <li class="breadcrumb-item active">Edit Customer</li>
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
                      <h3 class="card-title">Edit Customer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('admin.customers.update') }}">
                      @csrf
                      <input type="hidden" name="id" value="{{ $customer->id }}" />
                      <input type="hidden" name="user_id" value="{{ $customer->user_id }}" />
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name')?old('name'): $customer->user->name }}" name="name">
                           @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" placeholder="Email" value="{{ old('email')?old('email'):$customer->user->email }}" name="email">
                           @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" placeholder="Phone" value="{{ old('phone')?old('phone'): $customer->phone }}" name="phone">
                           @error('phone')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                          <div class="col-sm-10">
                            <textarea name="address" class="form-control" id="phone" placeholder="Address">{{ $customer->address }}</textarea>
                           @error('address')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
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