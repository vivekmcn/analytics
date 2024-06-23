@extends('layouts.mab')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Organic Traffic</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              
              
              
            <!-- <ol class="breadcrumb float-sm-right">
              @if(auth::user()->can('customer-dashboard'))
              <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">{{ __('Home') }}</a></li>
              @endif
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-lg-12 col-12">
              <!-- solid sales graph -->
            <div class="card ">
              <div class="card-header border-0">
               
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              
            </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection


@push('scripts')
<script src="{{asset('theme/mab/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('theme/mab/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript">
    const labels = [{!! $dayMonths !!}];
    let dataSets = [];
    const COLORS = [
      '#4dc9f6',
      '#f67019',
      '#f53794',
      '#537bc4',
      '#acc236',
      '#166a8f',
      '#00a950',
      '#58595b',
      '#8549ba'
    ];
    <?php foreach ($majorChannels as $key => $channel): ?>
      dataSets.push({
        'label' : '{{ $channel }}',
        fill: false,
        'data' : [{!! implode(",",$ga4DataSetsSolid[$channel]) !!}],
        'borderColor' : COLORS[{{$key}}],
        backgroundColor:COLORS[{{$key}}]
      });
    <?php endforeach ?>
    <?php foreach ($majorChannels as $key => $channel): ?>
      dataSets.push({
        'label' : '{{ $channel }}',
        fill: false,
        'data' : [{!! implode(",",$ga4DataSetsDotted[$channel]) !!}],
        borderDash: [5, 5],
        'borderColor' : COLORS[{{$key}}],
        backgroundColor:COLORS[{{$key}}]
      });
    <?php endforeach ?>
    const data = {
      labels: labels,
      datasets:dataSets
    }
    var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        ticks: {
          fontColor: '#58c479'
        },
        gridLines: {
          display: false,
          color: '#58c479',
          drawBorder: false
        }
      }],
      yAxes: [{
        ticks: {
          stepSize: 5000,
          fontColor: '#58c479'
        },
        gridLines: {
          display: true,
          color: '#58c479',
          drawBorder: false
        }
      }]
    }
  }
  console.log(data);
    var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
     var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
       type: 'line',
       data: data,
       options: salesGraphChartOptions
      });
</script>
@endpush