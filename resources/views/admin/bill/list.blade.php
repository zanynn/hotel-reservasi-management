@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bill
                    <small>{{$reservation->name}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (session('annoucement'))
            <div class="alert alert-success">
                {{session('annoucement')}}
            </div>
            @endif
            <?php $sum = 0; ?>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        {{-- <th>ID</th> --}}
                        <th>Content</th>
                        <th>Cost</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bill as $b)
                    <tr class="odd gradeX" align="center">
                        {{-- <td>{{$b->id}}</td> --}}
                        <td>{{$b->content}}</td>
                        <td>IDR.{{number_format($b['price'], 0, "," , ".")}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/bill/delete/{{$b->id}}/{{$reservation->id}}"> Delete</a></td>
                    </tr>
                    <?php $sum = $sum + $b->price; ?>
                    @endforeach
                </tbody>

            </table>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-warning"> <a href="admin/bill/add/{{$reservation->id}}"> Tambah Layanan lainnya </a> </button>
                <button class="btn btn-warning"> <a href="exportInvoice/{{$reservation->id}}">Faktur</a> </button>
                <button class="btn btn-warning"> <a href="admin/reservation/delete/{{$reservation->id}}">Checkout</a> </button>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Total biaya: IDR.{{number_format($sum, 0, "," , ".")}}</h2>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    @endsection