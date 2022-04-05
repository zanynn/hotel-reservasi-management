@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category Room
                    <small>Edit</small>
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

                <form action="admin/category_room/editPost/{{$category_room->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label>Type of Rooms</label>
                        <input class="form-control" name="name" value="{{$category_room->name}}" />
                    </div>

                    <div class="form-group">
                        <label>Photo </label>
                        <input type="file" class="form-control" name="image" value="{{$category_room->image}}" />
                    </div>

                    <div class="form-group">
                        <label>Price </label>
                        <input class="form-control" name="price" value="{{$category_room->price}}" />
                    </div>
                    <?php
                    $categoryRoomOp = DB::table('category_room')->select('category_wisma')->distinct()->get();
                    ?>
                    <div class="form-group">
                        <label>Category Wisma</label>
                        <select name="category_wisma" id="room" class="form-control">
                            @foreach ($categoryRoomOp as $r)
                            <option value="{{ $r->category_wisma}}">
                                @if ($r->category_wisma==1)
                                {{'Wisma Albakor'}}
                                @else {{'Wisma Madidihang'}}
                                @endif
                                @endforeach
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description </label>
                        <input class="form-control" name="description" value="{{$category_room->description}}" />
                    </div>


                    <button type="submit" class="btn btn-default">Edit </button>
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