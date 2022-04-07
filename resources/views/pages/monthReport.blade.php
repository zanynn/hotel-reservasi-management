@extends('admin.layout.index')
@section('content')
<!-- Main Application (Can be VueJS or other JS framework) -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <h1>Laporan Bulan : Desember 2021</h1>
            <div class="form-group">
                <label for="">Pilih Bulan</label>
                <select name="" id="">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="row">
                
        </div>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
@endsection

{{-- {!! $chart->script() !!} --}}
@section('script')

@endsection