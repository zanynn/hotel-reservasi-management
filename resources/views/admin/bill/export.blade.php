<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>#{{$reservation->id}} | FAKTUR PEMESANAN WISMA & GUEST HOUSE UPT PPP PONDOKDADAP</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
    p {
        margin: 0px;
    }
</style>
</head>
<body>
    <div class="container mt-3">
        <div class="text-center">
            <img width="200" src="http://wisma.infopondokdadap.com/wp-content/uploads/2019/02/cropped-Wisma-Pondap.png" alt="">
        </div>
        <h2 class="mt-3 fw-bold">Faktur Pemesanan</h2>
        <div class="d-flex justify-content-between">
            <div class="">
                <p class="fw-bold">Tagihan Dari:</p>
                <p>UPT PPP Pondokdadap</p>
                <p>HP : +62 82 177 873 584
                <p>e-mail : wismapondokdadap@gmail.com</p>
                <p>Dsn. Sendang Biru, Dsn. Tambakrejo, Kec. Sumbermanjing Wetan, Malang</p>
            </div>
            <div class="">
                <p class="fw-bold">Tagihan untuk:</p>
                <p>{{$reservation->name}}</p>
                <p>{{$reservation->phone}}</p>
                <p>{{$reservation->email}}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <p>Informasi Pemesanan</p>
                <table class="table table-bordered">
                    <tr>
                        <th>No Pemesanan</th>
                        <td>{{$reservation->id}}</td>
                    </tr>
                    <tr>
                        <th>Kamar</th>
                        <td>{{$room->name}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Check In</th>
                        <td>{{date('d M Y', strtotime($reservation->DateIn))}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Check Out</th>
                        <td>{{date('d M Y', strtotime($reservation->DateOut))}}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Orang</th>
                        <td>{{$reservation->Numbers}}</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>{{$reservation->notes ?? "Tidak ada catatan"}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p>Detail Pelayanan</p>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Deskripsi Layanan</th>
                        <th>Harga</th>
                    </tr>
                    @foreach ($bill_details as $key => $bill_detail)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$bill_detail->content}}</td>
                        <td>Rp. {{number_format($bill_detail->price,2,',','.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-end fw-bold">Total Tagihan</td>
                        <td>Rp. {{number_format($total_price,2,',','.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <p>Terimakasih telah berkunjung dan mempercayai layanan Wisma UPT PPP Pondokdadap</p>
        <p>Selamat Datang Kembali</p>
    </div>
        <script>
            window.print();
        </script>
</body>
</html>