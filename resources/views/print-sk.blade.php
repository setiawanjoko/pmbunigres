<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @media print {
            body {
                padding-top: 0;
            }

            #action-area {
                display: none;
            }
        }

        .myTable {
            border-collapse:collapse;
        }
        .myTable th {
            background-color: aliceblue;
            color:black;
            font-size: 0.8em;
        }
        .myTable td, .myTable th {
            padding:5px;
            border:1px solid #000;
            text-align: right;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Surat Keterangan Lulus</title>
</head>
<body>
    <div id="action-area">
        <div id="navbar-wrapper" style="padding: 12px 16px;font-size: 0;line-height: 1.4; box-shadow: 0 -1px 7px 0 rgba(0, 0, 0, 0.15); position: fixed; top: 0; left: 0; width: 100%; background-color: #FFF; z-index: 100;">
            <div style="width: 50%; display: inline-block; vertical-align: middle; font-size: 12px;"></div>
            <div style="width: 50%; display: inline-block; vertical-align: middle; font-size: 12px; text-align: right;">
                <a class="btn-print" href="javascript:window.print()" style="height: 100%; display: inline-block; vertical-align: middle;">
                    <button id="print-button" style="border: none; height: 100%; cursor: pointer;padding: 8px 40px;border-color: #03AC0E;border-radius: 8px;background-color: #03AC0E;margin-left: 16px;color: #fff;font-size: 12px;line-height: 1.333;font-weight: 700;">Cetak</button>
                </a>
            </div>
        </div>
    </div>
    <div class="content-area">
        <div style="margin: auto; width: 790px;">
            <div class="m-5">
                <img class="mb-3" style="width: 42%" src="{{ asset('unigres/images/kop-surat.png') }}" alt="" srcset="">
                <p class="text-center h4"><strong>SURAT KETERANGAN</strong></p>
                <p class="text-center">NO : {{ $pembayaran->no_surat }}</p>
                <p>
                Berdasarkan hasil seleksi Penerimaan Mahasiswa Baru Universitas Gresik, dengan ini diputuskan bahwa calon mahasiswa :
                </p>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td width="20%">Nama</td>
                            <td width="5%">&nbsp;:&nbsp;</td>
                            <td>{{ $biodata->nama_depan . ' ' . $biodata->nama_belakang }}</td>
                        </tr>
                        <tr>
                            <td width="20%">No. Registrasi</td>
                            <td width="5%">&nbsp;:&nbsp;</td>
                            <td>{{ $biodata->no_pendaftaran }}</td>
                        </tr>
                        <tr>
                            <td width="20%">Program Studi</td>
                            <td width="5%">&nbsp;:&nbsp;</td>
                            <td>{{ $prodi->nama }}</td>
                        </tr>
                        <tr>
                            <td width="20%">Gelombang</td>
                            <td width="5%">&nbsp;:&nbsp;</td>
                            <td>{{ $gelombang->gelombang }}</td>
                        </tr>
                    </tbody>     
                </table>
                <br>
                <p>Dinyatakan <strong>DITERIMA</strong>, sebagai mahasiswa Universitas Gresik, Tahun Akademik 2021/2022, Selanjutnya agar melakukan heregistrasi dengan rincian pembayaran sebagai berikut :</p>
                <table class="myTable" width="100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="text-center">Heregistrasi</th>
                        <th class="text-center">Dana Kemahasiswaan</th>
                        <th class="text-center">Dana Pengembangan (Pembayaran ke -1)</th>
                        <th class="text-center">SPP Semester I (3 Bulan)</th>
                        <th class="text-center">Seragam</th>
                        <th class="text-center">Konversi</th>
                        <th class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ number_format($biaya->heregistrasi, 0, '', '.') }},-</td>
                            <td>{{ number_format($biaya->dana_kemahasiswaan, 0, '', '.') }},-</td>
                            <td>{{ number_format($biaya->dana_pengembangan, 0, '', '.') }},-</td>
                            <td>{{ number_format($biaya->spp_semester, 0, '', '.') }},-</td>
                            <td>{{ number_format($biaya->seragam, 0, '', '.') }},-</td>
                            <td>{{ number_format($biaya->konversi, 0, '', '.') }},-</td>
                            <td>{{ number_format($biaya->total_daftar_ulang, 0, '', '.') }},-</td>
                        </tr>
                    </tbody>
                </table>
                </p>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="50%"></td>
                        <td width="50%">
                            <div style="text-align: right;">
                                <p style="text-align: left; padding-left:100px;">Gresik, {{ $tanggal }}</p>
                                <img style="width: 70%" src="{{ asset('unigres/images/ttd-surat.jpg') }}" alt="" srcset="">
                            </div>
                        </td>
                    </tr>        
                </table>    
            </div>
        </div>
    </div>    
</body>
</html>
