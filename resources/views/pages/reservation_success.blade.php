<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="py-5" style="margin-top: 60px">
        <div class="text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div>
                            <h1 class="display-4 fw-bold">Berhasil Reservasi Kamar</h1>
                            <h3>Anda Mendapatkan Kamar {{$room->name}}</h3>
                            <div class="text-success mb-3">
                                <i class="fa-solid fa-circle-check fa-5x"></i>
                            </div>
                            <p>Tolong transfer nominal dibawah untuk menyelesaikan pembayaran</p>
                            <p class="font-weight-bold display-3 fw-bold">Rp. {{number_format($total_price, 2,',','.')}}</p>
                            <p>Transfer nominal diatas ke:</p>
                            <div class="d-flex justify-content-center">
                                <div style="max-width: 200px">
                                    <img class="img-fluid"
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/2560px-BANK_BRI_logo.svg.png"
                                        alt="">
                                </div>
    
                                <div class="text-start ms-4">
                                    <p class="ms-0 h4 m-0 fw-bold">735301010667539</p>
                                    <p class="mt-2">a/n FEBRYAN ALVIANUS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <p>Informasi Pemesan</p>
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$reservation->name}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$reservation->phone}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$reservation->email}}</td>
                        </tr>
                        <tr>
                            <th>Person in Room</th>
                            <td>{{$reservation->Numbers}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <p>Informasi Pemesanan</p>
                    <table class="table table-bordered">
                        <tr>
                            <th>Check In</th>
                            <td>{{date('d M Y', strtotime($reservation->DateIn))}}</td>
                        </tr>
                        <tr>
                            <th>Check Out</th>
                            <td>{{date('d M Y', strtotime($reservation->DateOut))}}</td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td>{{$reservation->Notes}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{$reservation->status}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 mt-5">
                    <p>Tekan tombol dibawah ini untuk menyelesaikan pembayaran melalui Whatsapp</p>
                    <a href="https://api.whatsapp.com/send?phone={{$admin_phone_number}}&text=KONFIRMASI%20PEMBAYARAN%0AGuest%20House%20Pondokdadap%0A------------------------------------------------%0ANama%20%3A%20{{$reservation->name}}%0ANo.%20Telp%20%3A%20{{$reservation->phone}}%0AKamar%20%3A%20{{$room->name}}%0ATanggal%20Check%20In%20%3A%20{{date('d M Y', strtotime($reservation->DateIn))}}%0ATanggal%20Check%20Out%20%3A%20{{date('d M Y', strtotime($reservation->DateOut))}}%0AJumlah%20Orang%20%3A%20{{$reservation->Numbers}}%0AOrder%20ID%20%3A%20{{$reservation->id}}%0A%0A%0ABerikut%20saya%20lampirkan%20bukti%20pembayaran%0A!UPLOAD%20BUKTI%20PEMBAYARANMU%20DISINI!" class="btn btn-primary w-100 py-2">Selesaikan Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>