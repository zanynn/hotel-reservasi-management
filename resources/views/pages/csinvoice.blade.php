@extends('layout.index')
@section('content')
<section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center" data-aos="fade">
        <h1 class="heading mb-3">Reservation Form</h1>
        <ul class="custom-breadcrumbs mb-4">
          <li><a href="home">Home</a></li>
          <li>&bullet;</li>
          <li>Invoice</li>
        </ul>
      </div>
    </div>
  </div>

  <a class="mouse smoothscroll" href="#next">
    <div class="mouse-icon">
      <span class="mouse-wheel"></span>
    </div>
  </a>
</section>
<!-- END section -->


<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <div class="card-body">
          <table id="multi-colum-dt" class="table table-striped table-bordered nowrap dataTables_wrapper dt-bootstrap4 data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Total Pembelian</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @php $no=1; @endphp
              @foreach($reservation as $order)
              <tr>
                <td>{{$no++}}</td>
                <td class="text-uppercase">#{{$order->id()}}</td>
                <td>{{$order['name']}}</td>
                <td>{{$order['userEmail']}}</td>
                <td>IDR {{number_format($order['totalOrder'], 0, "," , ".")}}</td>
                <td>{{$order['orderDateTime']}}</td>
                <td>

                <td align="center">
                  <a href="" target="_blank" class="btn btn-info" style="width:35px;"><i class="ik ik-eye"></i></a>

                  <a href="#" id="showProduct" class="btn btn-warning" style="width:35px; background-color:#ffc107; border:none;" data-toggle="modal" data-target="#order-edit{{$order->id()}}"><i class="ik ik-edit"></i></a>
                  <!-- modal -->
                </td>
              </tr>
              <div class="modal fade" id="order-edit{{$order->id()}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongLabel">Transaksi #{{$order->id()}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <button type="button" class="close" onClick='bukaWa();' data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                      <script>
                        //Opsi WhatsApp
                        function bukaWa() {
                          window.location = "https://api.whatsapp.com/send?phone=&text=testt,";
                        }
                      </script>


                    </div>

                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection