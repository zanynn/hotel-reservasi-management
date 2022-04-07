<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
    <title>Laporan Bulan {{$months[request('month') - 1]}} | Guest House & Wisma UPT PPP PONDOKDADAP</title>
</head>
<body>
    
    <div class="container mt-4">
        <div class="text-center">
            <img width="200" src="http://wisma.infopondokdadap.com/wp-content/uploads/2019/02/cropped-Wisma-Pondap.png" alt="">
        </div>
        <div class="mt-3">
            <div class="text-center">
                <p class="m-0">UPT PPP Pondokdadap</p>
                <p class="m-0">HP : +62 82 177 873 584
                <p class="m-0">e-mail : wismapondokdadap@gmail.com</p>
                <p class="m-0">Dsn. Sendang Biru, Dsn. Tambakrejo, Kec. Sumbermanjing Wetan, Malang</p>
            </div>
            
        </div>
        <h1 class="mt-4">Laporan Bulan : {{$months[request('month') - 1]}} </h1>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Pemesan Kamar</th>
                <th>Daftar Tagihan</th>
                <th>Tanggal Pesan</th>
            </th>
            @foreach ($reservations as $key => $reservation)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$reservation->name}}</td>
                <td>Rp. {{number_format($reservation->total_bill,2,',','.')}}</td>
                <td>{{date('d M Y   ',strtotime($reservation->DateIn))}}</td>
            </tr>
            
            @endforeach
            <tr>
                <td colspan="2">Total Pendapatan</td>
                <td colspan="2">Rp. {{number_format($monthly_income,2,',','.') }}</td>
            </tr>
        </table>
    </div>

    <script>window.print()</script>
</body>
</html>