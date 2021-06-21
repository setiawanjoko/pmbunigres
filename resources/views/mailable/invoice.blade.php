<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UNIGRES</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, Helvetica, sans-serif }
        div:after { content: ""; clear: both; display: table; }
        td.center { text-align: center;}
        .col-1 { width: 8.33333333%; }
        .col-2 { width: 16.66666667%; }
        .col-3 { width: 25%; }
        .col-4 { width: 33.33333333%; }
        .col-5 { width: 41.66666667%; }
        .col-6 { width: 50%; }
        .col-7 { width: 58.33333333%; }
        .col-8 { width: 66.66666667%; }
        .col-9 { width: 75%; }
        .col-10 { width: 83.33333333%; }
        .col-11 { width: 91.66666667%; }
        .col-12 { width: 100%; }
        .left { float: left; }
        .right { float:right; }
        .sm-display { display: none; }
        .sm-hidden { display: table-cell; }

        @media only screen and (max-width: 500px)  {
            .sm-hidden { display: none; }
            .sm-display { display: table-cell; }
            .col-sm-1 { width: 8.33333333%; }
            .col-sm-2 { width: 16.66666667%; }
            .col-sm-3 { width: 25%; }
            .col-sm-4 { width: 33.33333333%; }
            .col-sm-5 { width: 41.66666667%; }
            .col-sm-6 { width: 50%; }
            .col-sm-7 { width: 58.33333333%; }
            .col-sm-8 { width: 66.66666667%; }
            .col-sm-9 { width: 75%; }
            .col-sm-10 { width: 83.33333333%; }
            .col-sm-11 { width: 91.66666667%; }
            .col-sm-12 { width: 100%; }
        }
    </style>
</head>
<body>
<div style="width: 100% !important; margin: 0 auto; background-color: #E5E5E5; padding:32px 0px;">
    <div style="max-width: 954px; margin: auto; background-color: #ffffff; border-radius: 6px; padding: 0px 32px 42px 32px; margin-bottom: 18px;">
        <div class="col-12" style="border-bottom: .6px solid rgba(0, 0, 0, 0.137); padding: 24px 0px; overflow: auto">
            <div class="col-6 left">
                <img class="left" src="https://i.ibb.co/VtV5DQx/logo.png" style="width: 48px; margin-right: 12px; vertical-align: middle">
                <p style="font-family: Helvetica, sans-serif;
                    font-size: 24px;
                    color: #0078BA; margin: 8.461px 0;">PMB.<span style="font-weight: bold;">Unigres</span></p>
            </div>
            <a class="col-6 right" href="http://www.unigres.ac.id" style="text-decoration: none;">
                <img class="right" style="margin: 10.46px 0 10.46px 10px; width: 24px;" src="https://i.ibb.co/WgtXkYn/notification-active.png">
                <p class="right" style="font-size: 16px; color: #11222B; font-family: Arial, Helvetica, sans-serif; margin: 13.46px 0px;">www.unigres.ac.id</p>
            </a>
        </div>
        <div style="margin-bottom: 32px; padding-top: 32px; padding-bottom: 52px; border-bottom: 1px solid rgba(0, 0, 0, 0.137);">
            <div class="col-12" style=" overflow: auto">
                <p class="col-9 left" style="font-size: 24px; font-family: Helvetica, sans-serif; color: #11222B; margin: 0px 0px 12px 0px;">Halo {{ $user->nama }}, </p>
                <p class="col-3 right" style="color: #8F8E94; margin: 0px; text-align: right;">{{ \Carbon\Carbon::today()->translatedFormat('d F Y') }}</p>
            </div>
            <div style="font-size: 32px; font-weight: bold; color: #11222B; margin: 0px 0px 28px 0px;">Selamat, registrasi akun anda berhasil!</div>
            <div style="font-size: 18px; font-weight: normal; color: #8F8E94; margin: 0px 0px 42px 0px;">Segera lakukan pembayaran untuk melanjutkan proses pendaftaran.</div>
            <table border="0" style="color: #8F8E94">
                <tbody>
                <tr>
                    <td style="text-align: right;">Virtual Account</td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <img src="http://pmb.unigres.ac.id/unigres/images/briva.png" style="height: 30px;" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">Kode Virtual Account</td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td style="font-weight: bold; color: #11222B; line-height: 36px;">{{ env('BRIVA_NO') . ' ' . $data->custCode }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">Jumlah</td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td style="font-weight: bold; color: #11222B; line-height: 36px; font-size: larger">Rp. {{ number_format($data->amount, 0), '', '.' }},-</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div style="color: #11222B; margin: 42px 0px 0px 0px;">
            <p style="font-size: 18px; font-weight: normal;">Petunjuk Pembayaran</p>
            <div style="color: #8F8E94; font-size: smaller">
                <p>ATM BRI</p>
                <ol type="1">
                    <li>Masukkan Kartu Debit BRI dan PIN anda</li>
                    <li>Pilih menu Transaksi Lainnya > Pembayaran > Lainnya > BRIVA</li>
                    <li>Masukkan 5 angka Kode Perusahaan untuk Universitas Gresik (10004) dan kode pembayaran (contoh: 10004 1234567890)</li>
                    <li>Di halaman konfirmasi, pastikan detail pembayaran sesuai seperti nomor BRIVA, nama pendaftar, dan jumlah yang harus dibayarkan</li>
                    <li>Ikuti instruksi untuk menyelesaikan transaksi</li>
                    <li>Simpan struk transaksi sebagai bukti pembayaran</li>
                </ol>
            </div>
            <div style="color: #8F8E94; font-size: smaller">
                <p>Mobile Banking BRI</p>
                <ol type="1">
                    <li>Masuk ke aplikasi Mobile Banking BRI</li>
                    <li>Pilih Pembayaran</li>
                    <li>Pilih BRIVA</li>
                    <li>Masukkan nomor BRIVA dan nominal pembayaran</li>
                    <li>Masukkan PIN anda</li>
                    <li>Tekan OK</li>
                    <li>SMS konfirmasi akan masuk ke nomor telepon anda jika transaksi berhasil</li>
                </ol>
            </div>
        </div>
    </div>
    <div style="max-width: 954px; margin: auto; background-color: #ffffff; border-radius: 6px; padding: 32px;">
        <p>Abaikan email ini apabila anda tidak merasa mendaftar pada Universitas Gresik atau sudah melakukan pembayaran. Cek status pembayaran anda
            <a href="{{ route('login') }}">disini</a>.</p>
        <p  style="text-align: center; font-size: 18px; font-weight: normal; color: #8F8E94; margin: 32px 0px 18px; padding-top: 32px; border-top: 1px solid rgba(0, 0, 0, 0.137);">Untuk informasi lebih lanjut mengenai PMB Unigres silahkan hubungi call center di bawah ini.</p>
        <div style="text-align: center">
            <span style="font-size: 12px; font-family: Helvetica, sans-serif; color: #000000;">Copyright © 2021 Universitas Gresik</span>
            <span style="font-size: 20px; font-family: Helvetica, sans-serif; color: #000000; margin: 0px 12px;">•</span>
            <span style="font-size: 12px; font-family: Helvetica, sans-serif; color: #000000;">Jl. Arif Rahman Hakim 2B, Gresik</span>
            <span style="font-size: 20px; font-family: Helvetica, sans-serif; color: #000000; margin: 0px 12px;">•</span>
            <span style="font-size: 12px; font-family: Helvetica, sans-serif; color: #000000;">Telp.(031) 3981918, 3978628</span>
            <span style="font-size: 20px; font-family: Helvetica, sans-serif; color: #000000; margin: 0px 12px;">•</span>
            <span style="font-size: 12px; font-family: Helvetica, sans-serif; color: #000000;">WA. 081 230 798 700</span>
        </div>
    </div>
</div>

</body>
</html>
