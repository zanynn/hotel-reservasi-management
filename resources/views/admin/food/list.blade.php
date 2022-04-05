@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Food
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
                        <th>Food's name</th>
                        <th>Food's Description</th>
                        <th>Price</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($food as $f)
                    <tr class="odd gradeX" align="center">
                        <td>{{$f->id}}</td>
                        <td>{{$f->name}}</td>
                        <td>{{$f->description}}</td>
                        <td>IDR{{number_format($f['price'], 0, "," , ".")}}</td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/food/edit/{{$f->id}}">Edit</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/food/delete/{{$f->id}}" onclick="return confirm('Are you sure you want to delete?');"> Delete</a></td>

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

@section('scripts')

@endsection