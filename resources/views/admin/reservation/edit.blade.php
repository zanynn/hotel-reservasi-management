@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reservation
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

                <form action="admin/reservation/editPost/{{$reservation->id}}" method="POST">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label>Room Name </label>
                        <select class="form-control" name="idRoom">
                            <label>Room Name</label>
                            @foreach ($room as $r)
                            <option value="{{$r->id}}" @if ($r->id==$reservation->idRoom) {{"selected"}} @endif > {{$r->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name Reservation</label>
                        <input class="form-control" name="name" placeholder="Please Enter Name" value="{{$reservation->name}}" />
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input class="form-control" name="phone" placeholder="Please Enter Phone" value="{{$reservation->phone}}" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" placeholder="Please Enter Email" value="{{$reservation->email}}" />
                    </div>
                    <div class="form-group">
                        <label>Check in: {{$reservation->DateIn}} </label>
                        <input type="date" class="form-control" name="DateIn" placeholder="Please Enter Date" value="{{$reservation->DateIn}}" />
                    </div>
                    <div class="form-group">
                        <label>Check out: {{$reservation->DateOut}}</label>
                        <input type="date" class="form-control" name="DateOut" placeholder="Please Enter Date" value="{{$reservation->DateOut}}" />
                    </div>
                    <div class="form-group">
                        <label>Person</label>
                        <input class="form-control" name="Numbers" placeholder="Please Enter Person" value="{{$reservation->Numbers}}" />
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <input class="form-control" name="Notes" placeholder="Please Enter Notes" value="{{$reservation->Notes}}" />
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