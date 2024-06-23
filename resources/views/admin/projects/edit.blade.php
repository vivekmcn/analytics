@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Project</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Customers</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.customers.view',['id' => $project->customer_id]) }}">View</a></li>
                  <li class="breadcrumb-item active">Edit Project</li>
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
                      <h3 class="card-title">Edit Project</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('admin.projects.update') }}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" value="{{ $project->id }}" />
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Name</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name')?old('name'):$project->name }}" name="name">
                           @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        
                         <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Logo</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control" id="logo" placeholder="Logo" name="logo">
                           @error('logo')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputGA4" class="col-sm-4 col-form-label">GA4 Enabled</label>
                          <div class="col-sm-8">
                            @if($project->is_ga4)
                                <input type="checkbox" id="ga4_enabled" name="ga4_enabled" checked="checked" value="1" />
                            @else
                                <input type="checkbox" id="ga4_enabled" name="ga4_enabled"  value="1" />
                            @endif
                            @error('ga4_enabled')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row ga4propval {{$project->is_ga4?'':'hide'}}">
                          <label for="inputGA4" class="col-sm-4 col-form-label">GA4 Property Id</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="property_id" name="property_id" value="{{ old('property_id')?old('property_id'):$project->property_id }}" placeholder="Property Id" />
                           @error('property_id')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Status</label>
                          <div class="col-sm-8">
                            <div class="form-group">
                              <div class="form-check">
                                <input type="radio" name="status" value="1" class="form-check-input" {{ $project->status==1?"checked":"" }} />
                                <label class="form-check-label">Active</label>
                              </div>
                              <div class="form-check">
                                <input type="radio" name="status" value="0" class="form-check-input" {{ $project->status==0?"checked":"" }} />
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
                        <button type="submit" class="btn btn-info">Update</button>
                        <a class="btn btn-default float-right" href="{{ route('admin.customers.view',['id' => $project->customer_id]) }}">Cancel</a>
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
  <style>
      .hide{
          display: none;
      }
  </style>
  <!-- /.content-wrapper -->
  @endsection
  @push('scripts')
  <script type="text/javascript">
      $(document).on("change", "#ga4_enabled", function(){
        if($(this).prop("checked")){
            $('.ga4propval').removeClass("hide");
        } else{
            $('.ga4propval').addClass("hide");
        }
      });
  </script>
  @endpush