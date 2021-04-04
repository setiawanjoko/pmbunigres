<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img style="width: 40%" src="{{ asset('unigres/images/kop-surat.png') }}" alt="" srcset="">
<h6>SURAT KETERANGAN</h6>
<p>NO : {{ nomorSurat() }}</p>
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
</p>
<br>
<br>
Gresik, {{ $tanggal }}
<img style="width: 20%" src="{{ asset('unigres/images/ttd-surat.jpg') }}" alt="" srcset="">
</body>
</html>
