@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Role Permissions</h1>
                    @if ($message = session()->has('success'))
                      <div class="alert alert-success" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                         {{ session()->get('success') }}
                       </div>
                    @endif
                    @if ($message = session()->has('warning'))
                      <div class="alert alert-danger" role="alert">
                        {{ session()->get('warning') }}
                      </div>
                    @endif
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Role Permissions</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-flex p-0">
                    <!-- <h3 class="card-title">Roles</h3> -->
                    <ul class="nav nav-pills ml-auto p-2">
                      <li class="nav-item">
                        <!-- <a href="{{ route('admin.permissions.add') }}" class="nav-link active">Create</a> -->
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="card-body">
                       <div class="card-body">
            <h4>Left Sided</h4>
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="roles" role="tablist" aria-orientation="vertical">
                  @foreach($roles as $id => $role)
                  <a class="nav-link" id="tab_{{ $id }}" data-toggle="pill" href="#vert-tabs-home" data-url="{{ route('admin.rolepermissions.get',['id' => $id]) }}" role="tab" aria-controls="vert-tabs-home">{{ $role }}</a>
                  @endforeach
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="permissiontab" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                     
                  </div>
                </div>
              </div>
            </div>
                    </div>     
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div>
        </section>
      
  </div>
  <!-- /.content-wrapper -->
  @endsection

  @push('scripts')
    <script>
      $(document).ready(function(){
          $("#roles").find('a.nav-link').first().trigger("click");
      });

      $(document).on("click", "#roles a.nav-link", function(){
          var url = $(this).attr('data-url');
          $.ajax({
            url : url
          }).done(function(data){
            $("#permissiontab").html(data);
          })
      });

      $(document).on("submit", "#rolepermissions", function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var formdata = $(this).serialize();
        $.ajax({
          url : url,
          data: formdata,
          type: 'post',
          dataType: 'json'
        }).done(function(data){
          if(data.status==1){
            alert("Permissions updated");
            $("#roles").find('a.nav-link.active').trigger("click");
          }
        })
        return false;
      });
    </script>
  @endpush