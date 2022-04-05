@extends('admin.layout.index')

@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Information
                            <small>More</small>
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

                        @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                        @endif
                        @if (session('loi'))
                        <div class="alert alert-success">
                            {{session('loi')}}
                        </div>
                        @endif

                        <form action="admin/tintuc/thempost" method="POST" enctype="multipart/form-data">
                             @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="idTheLoai" id="TheLoai">
                                    <option value="0">Select Genre</option>
                                    @foreach ($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" name="idLoaiTin" id="LoaiTin">
                                    <option value="0">Select Message Type</option>
                                    @foreach ($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" name="TieuDe" placeholder="Please Enter Category Name" />
                            </div>
                            <div class="form-group">
                                <label>Summary</label>
                                <textarea id="demo" name="TomTat" class="form-control ckeditor"> </textarea>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea id="demo" name="NoiDung" class="form-control ckeditor"> </textarea>
                            </div>
                            <div>
                                <label>Image</label>
                                <input type="file" name="Hinh">
                            </div>
                            <div class="form-group">
                                <label>Highlights</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" type="radio">No
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" checked="" type="radio">Yes
                                </label>
                                
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

@section('script')
    <script>
        $(document).ready(function(){
            $('#TheLoai').change(function(){ 
                var idTheLoai=$(this).val();
               // alert(idTheLoai);   
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    
                    //alert(data);
                    $('#LoaiTin').html(data);
            });
        });
        });

    </script>
@endsection