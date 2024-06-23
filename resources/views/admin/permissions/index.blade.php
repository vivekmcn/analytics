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
                  <li class="breadcrumb-item active">Permissions</li>
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
                        <a href="{{ route('admin.permissions.add') }}" class="nav-link active">Create</a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="datatable" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Sl no</th>
                        <th>Name</th>
                        <th>Controller</th>
                        <th>Method</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
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

  @push('scripts')
    <script src="{{asset('theme/mab/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/mab/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/mab/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('theme/mab/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/mab/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('theme/mab/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script>
  $(function () {
    // $("#datatable").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    @if(auth::user()->can('view-permission'))
    var view    =   "{{ route('admin.permissions.view', ['id' => '__id']) }}";
    @else
    var view    =  "";
    @endif

    @if(auth::user()->can('edit-permission'))
    var edit = "{{ route('admin.permissions.edit',['id'=>'__id']) }}";
    @else
    var edit = "";
    @endif

    @if(auth::user()->can('delete-permission'))
    var deletelink = "{{ route('admin.permissions.delete',['id'=>'__id']) }}";
    @else 
    var deletelink = "";
    @endif
    var slno = 0;
    $('#datatable').DataTable({
      "pageLength": 10,
          "responsive": true,
          "serverSide": true,
          "ordering": true,
          "aaSorting": [],
          "processing": true,
          "order": [[0, "desc"]],
          "columnDefs": [{
            "defaultContent": "-",
            "targets": "_all"
          }],
          "language": {
              "searchPlaceholder": 'Search...',
              "sSearch": '',
              "infoFiltered": " ",
              'loadingRecords': '&nbsp;',
              'processing': ''
          },
          "ajax": {
              "url": "{{ route('admin.permissions.paginate') }}",
              "type": "post",
              "data": function (data) {
                  data._token = "{{ csrf_token() }}";
                  return data;
              }
          },
          "columns": [
              { "data": "slno", "name": "slno", "render": function(data, type, row){
                      return ++slno;
                  } 
              },
              {"data": "name"},
              {"data": "controller"},
              {"data": "action"},
              {
                  "data": "action", "name": "action", "render": function (data, type, row) {
                      action = "<a class='edit btn btn-info' href='"+view.replace("__id",row.id)+"'><i class='fa fa-eye'></i></a> ";
                      action += "<a class='edit btn btn-info' href='"+edit.replace("__id",row.id)+"'><i class='fa fa-edit'></i></a> ";
                      action += "<a class='btn btn-danger' onclick='return confirm(\"Are you sure to delete this role? \")' href='"+deletelink.replace("__id",row.id)+"'><i class='fa fa-trash'></i></a>";
                      return action;
                  }
              }
          ],
          "fnCreatedRow": function (nRow, aData, iDataIndex) {
              //loadingShow();
              var info = this.dataTable().api().page.info();
              var page = info.page;
              var length = info.length;
              var index = (page * length + (iDataIndex + 1));
              $('td:eq(0)', nRow).html(index).addClass('text-center');
          },
          "fnDrawCallback": function (oSettings) {
              var info = this.dataTable().api().page.info();
              var totalRecords = info.recordsDisplay;
              //loadingHide();
              $('[data-toggle="popover"]').popover({ trigger: 'hover' });
              //updateTotalRecordsCount("total-records-orders", totalRecords);
          }
    });
  });
</script>
  @endpush