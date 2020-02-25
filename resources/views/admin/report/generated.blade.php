@extends('admin.layouts.dashboard-template')
@section('page-small-title','Report')
@section('page-title','Generated Report')
@section('content')
@include('templates.form-reminder')
<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        {{-- <button id="print-chart-btn">Print Chart</button> --}}
        <h6 class="m-0">Campus Form Report from <b>{{ $from_date->format('F d, Y') }}</b> to <b>{{ $to_date->format('F d, Y') }}</b></h6>
      </div>
      <div id="report-data" data-source="{{$campuses}}"></div>
      <div class="card-body pb-3">
      	<canvas id="campusFormsChart" width="400" height="400"></canvas>
      </div>
    </div>
  </div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/jspdf@1.5.3/dist/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
var ctx                 = document.getElementById('campusFormsChart').getContext('2d');
let campuses            = JSON.parse(document.getElementById('report-data').getAttribute('data-source'));
let campusNames         = [];
let campusFormSubmitted = [];

campuses.forEach((campus) => {
    campusNames.push(campus.name);
    campusFormSubmitted.push(campus.forms_count);
});

var campusFormsChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: campusNames,
        datasets: [{
            label: '# of Submitted Forms',
            data: campusFormSubmitted,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

$('#print-chart-btn').on('click', function() {
     var canvas = document.getElementById("campusFormsChart");
    var win = window.open();
    win.document.write("<br><img src='" + canvas.toDataURL() + "'/>");
    win.print();
});

</script>
@endpush
@endsection