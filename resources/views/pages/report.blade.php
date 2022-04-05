@extends('admin.layout.index')
@section('content')
<!-- Main Application (Can be VueJS or other JS framework) -->
<input type="hidden" id="month_1" value="{{$month1}}">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <canvas id="reportChart" width="300" height="300" style="max-height: 500px !important;">
                </canvas>
                <!-- End Of Main Application -->
            </div>
            <h2 style="text-align: center;"> Bagan Pendapatan Bulan 2022</h2>
        </div>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
{{-- {!! $chart->script() !!} --}}
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var reportChart = document.getElementById('reportChart');
        var month1 = $('#month_1').val();
        var myChart = new Chart(reportChart, {
            type: 'bar',
            data: {
                labels: ['Bulan 1', 'Bulan 2', 'Bulan 3', 'Bulan 4', 'Bulan 5', 'Bulan 6', 'Bulan 7', 'Bulan 8', 'Bulan 9', 'Bulan 10', 'Bulan 11', 'Bulan 12', ],
                datasets: [{
                    label: '',
                    data: [month1, 190, 130, 50, 200, 350, 100, 500, 400, 240, 1000, 1400],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
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
                        'rgba(255, 159, 64, 1)',
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
    });
</script>
@endsection