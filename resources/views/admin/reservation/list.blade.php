@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reservation
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (session('annoucement'))
            <div class="alert alert-success">
                {{session('annoucement')}}
            </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        {{-- <th>ID</th> --}}
                        <th>Rooms Name</th>
                        <th>Fullname</th>
                        <th>Phone Number</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Person</th>
                        <th>Status Pembayaran</th>
                        {{-- <th>Notes</th> --}}
                        <th>Edit</th>

                        <th>Bill</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservation as $r)
                    <tr class="odd gradeX" align="center">
                        {{-- <td>{{$r->id}}</td> --}}
                        <td>
                            @foreach ($room as $ro) @if ($ro->id==$r->idRoom) {{$ro->name}} @endif @endforeach
                        </td>
                        <td>{{$r->name}}</td>
                        <td>
                        <a href="https://wa.me/{{$r->phone}}">{{$r->phone}}</a>    
                        </td>
                        <td>{{date('d M Y', strtotime($r->DateIn))}}</td>
                        <td>{{date('d M Y', strtotime($r->DateOut))}}</td>
                        <td>{{$r->Numbers}}</td>
                        <td>{{$r->status}}</td>
                        {{-- <td>{{$r->Notes}}</td> --}}

                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/reservation/edit/{{$r->id}}">Edit</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/bill/list/{{$r->id}}"> View details</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/reservation/delete/{{$r->id}}" onclick="return confirm('Are you sure you want to delete?');"> Delete</a></td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection