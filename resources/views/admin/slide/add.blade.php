@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">

                @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                    {{$err}} <br>
                    @endforeach
                </div>
                @endif

                @if (session('annoucement'))
                <div class="alert alert-success">
                    {{session('annoucement')}}
                </div>
                @endif

                <form action="admin/slide/addpost" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label>Link Image </label>
                        <input type="file" class="form-control" name="link" />
                    </div>
                    <div class="form-group">
                        <label>Caption</label>
                        <input class="form-control" name="caption" />
                    </div>


                    <button type="submit" class="btn btn-default">Add </button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection