@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Room
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
                        <th>ID</th>
                        <th>Rooms Name</th>
                        <th>Type of Room</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($room as $r)
                    <tr class="odd gradeX" align="center">
                        <td>{{$r->id}}</td>
                        <td>{{$r->name}}</td>
                        <td>
                            @if ($r->idCategory==1) {{"Standard Room"}} @endif
                            @if ($r->idCategory==2) {{"Exclusive Room"}} @endif
                            @if ($r->idCategory==3) {{"Private Room"}} @endif
                            @if ($r->idCategory==4) {{"Standard"}} @endif

                        </td>
                        <td>
                            @if ($r->Status==1) {{"Empty"}}
                            @else {{"Reserved"}}
                            @endif
                        </td>

                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/room/edit/{{$r->id}}">Edit</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/room/delete/{{$r->id}}" onclick="return confirm('Are you sure you want to delete?');"> Delete</a></td>

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