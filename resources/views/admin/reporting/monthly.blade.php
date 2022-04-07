@extends('admin.layout.index')
@section('content')
<!-- Main Application (Can be VueJS or other JS framework) -->
<div id="page-wrapper">
    <div class="container-fluid">
            <h1>Laporan Bulan : 
                @if(request('month') && request('year')) {{$months[request('month') - 1]}} {{request('year')}} @endif </h1>
            <form action="" method="GET">
                <div class="row ">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Pilih Bulan</label>
                            <select class="form-control" name="month" id="">
                                @foreach ($months as $key => $month)
                                <option value="{{$key + 1}}">{{$month}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Pilih Tahun</label>
                            <select class="form-control" name="year" id="">
                                @foreach ($years as $key => $year)
                                <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary px-4">Lihat Laporan</button>
                    </div>
                </div>
            </form>
        <div class="row ">
            <div class="col-md-12">
                @if (count($reservations) > 0)
                <div style="display: flex;justify-content:space-between;align-items:center">
                    <p style="margin-top: 30px">Statistik Bulan Ini</p>
                    <a href="/admin/report/monthly?month={{request('month')}}&year={{request('year')}}&is_export=1" class="btn btn-danger">Buat Laporan PDF</a>
                </div>
                <div>
                    <canvas id="monthly_chart" height="280" width="600"></canvas>
                </div>

                <p style="margin-top: 30px">Daftar Tagihan</p>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan Kamar</th>
                        <th>Daftar Tagihan</th>
                        <th>Tanggal Pesan</th>
                    </th>
                    @foreach ($reservations as $key => $reservation)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$reservation->name}}</td>
                        <td>Rp. {{number_format($reservation->total_bill,2,',','.')}}</td>
                        <td>{{date('d M Y   ',strtotime($reservation->DateIn))}}</td>
                    </tr>
                    
                    @endforeach
                    <tr>
                        <td colspan="2">Total Pendapatan</td>
                        <td colspan="2">Rp. {{number_format($monthly_income,2,',','.') }}</td>
                    </tr>
                </table>

                
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
@if (count($reservations) > 0)

@section('script')
<script src="{{asset('js/chart-min.js')}}" ></script>

<script>
    var ctx = document.getElementById("monthly_chart").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($stats_label) !!},
        datasets: [{
            label: {!! json_encode($months[request('month') - 1]) !!}, // Name the series
            data: {!! json_encode($stats_data) !!}, // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});
</script>
@endsection
@endif