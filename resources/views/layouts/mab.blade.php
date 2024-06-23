<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}" >
  <title>MAB Analytics | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arimo&family=Lato&family=Oswald&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/css2?family=Arimo&family=Lato&family=Open+Sans&family=Oswald&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/theme/mab/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('/theme/mab/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
  <link rel="stylesheet" type="text/css" href="{{asset('/theme/mab/dist/css/mab-custom.css')}}" />
  
  <style type="text/css">
      .sidebar-collapse .brand-link .brand-image{
          margin-left: 0px !important;
      } 
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img src="{{asset('images/mab_logo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>
    <h4>
     @if(auth::user()->can('admin-dashboard'))
        {{ auth::user()->name }}
        @else
        @php
            $customer = \App\Models\Customer::where('user_id', auth::user()->id)->first();
            $customerprojects = \App\Models\CustomerProject::where('customer_id', $customer->id)->pluck('project_id' ,'id')->toArray();
            $project = \App\Models\Project::whereIn('id', $customerprojects)->first()->toArray();
        @endphp
        @if(file_exists(public_path() . '/logo/'.$project['logo']))
        <img src="{{asset('logo/'.$project['logo'])}}" style='height: 30px' alt="User Image">
        @else
        {{ auth::user()->name }}
        @endif
    @endif
    </h4>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
      <img src="{{ asset('theme/mab/dist/img/MAB_Logo_Lotus Only.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8"> 
      <span class="brand-text font-weight-light">MAB Analytics</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> -->
          @if(auth::user()->can('admin-dashboard'))
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{ __('Dashboard') }}
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @else
            @if(auth::user()->can('customer-dashboard'))
              <li class="nav-item">
                <a href="{{ route('customer.dashboard') }}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    {{ __('Dashboard') }}
                    <!-- <span class="right badge badge-danger">New</span> -->
                  </p>
                </a>
              </li>
            @endif
            
          @endif

          @if(auth::user()->can('list-roles'))
          <li class="nav-item">
            <a href="{{ route('admin.roles') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{ __('Roles') }}
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @endif

          @if(auth::user()->can('list-permissions'))
          <li class="nav-item">
            <a href="{{ route('admin.permissions') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{ __('Permissions') }}
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @endif
          
          @if(auth::user()->can('list-role-permissions'))
          <li class="nav-item">
            <a href="{{ route('admin.rolepermissions.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{ __('Role Permissions') }}
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @endif
          
          @if(auth::user()->can('list-users'))
          <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{ __('Users') }}
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          @endif
          
          @if(auth::user()->can('list-customers'))
           <li class="nav-item">
            <a href="{{ route('admin.customers') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{ __('Customers') }}
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          @endif
          
          <li class="nav-item">
              <hr style="border-top: 1px solid #fff">
            <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="nav-icon fas"></i>
                                                    <p>
                                        {{ __('Logout') }}
                                      </p>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <footer class="main-footer">
    <strong>Copyright &copy; {{ date("Y") }} <a href="https://mab.agency/">Mab</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('/theme/mab/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/theme/mab/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('/theme/mab/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('/theme/mab/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('/theme/mab/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('/theme/mab/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('/theme/mab/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/theme/mab/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('/theme/mab/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('/theme/mab/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('/theme/mab/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('/theme/mab/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('/theme/mab/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/theme/mab/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/theme/mab/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('/theme/mab/dist/js/pages/dashboard.js')}}"></script>
@stack('scripts')
</body>
</html>
