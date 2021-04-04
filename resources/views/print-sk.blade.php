<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Surat Keterangan Lulus</title>

</head>
<body>
    <img style="width: 40%" src="{{ asset('unigres/images/kop-surat.png') }}" alt="" srcset="">
<p>SURAT KETERANGAN</p>
<p>NO : {{ $pembayaran->no_surat }}</p>
<br>
<p>
Berdasarkan hasil seleksi Penerimaan Mahasiswa Baru Universitas Gresik, dengan ini diputuskan bahwa calon mahasiswa :
<br>
Nama 	:	{{ $biodata->nama_depan . ' ' . $biodata->nama_belakang }}
<br>
No. Registrasi	:	{{ $biodata->no_pendaftaran }}
<br>
Program Studi 	: {{ $prodi->nama }}
<br>
Gelombang	:	{{ $gelombang->gelombang }}
<br>
<br>
Dinyatakan DITERIMA, sebagai mahasiswa Universitas Gresik, Tahun Akademik 2021/2022, Selanjutnya agar melakukan heregistrasi dengan rincian pembayaran sebagai berikut :
<br>
<table class="table">
    <thead>
      <tr>
        <th>Heregistrasi</th>
        <th>Dana Kemahasiswaan</th>
        <th>Dana Pengembangan (Pembayaran ke -1)</th>
        <th>SPP Semester I (3 Bulan)</th>
        <th>Seragam</th>
        <th>Konversi</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $biaya->heregistrasi }}</td>
            <td>{{ $biaya->dana_kemahasiswaan }}</td>
            <td>{{ $biaya->dana_pengembangan }}</td>
            <td>{{ $biaya->spp_semester }}</td>
            <td>{{ $biaya->seragam }}</td>
            <td>{{ $biaya->konversi }}</td>
            <td>{{ $biaya->total_daftar_ulang }}</td>
        </tr>
    </tbody>
</table>
</p>
<br>
<br>
Gresik, {{ $tanggal }}
<img style="width: 20%" src="{{ asset('unigres/images/ttd-surat.jpg') }}" alt="" srcset="">
</body>
</html>
