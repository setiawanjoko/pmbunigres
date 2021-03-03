
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    
    <link href="http://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    
    <link href="{{ asset('unigres/css/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('unigres/css/responsive.css') }}" rel="stylesheet"/>  

    <title>Unigres</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light second-nav dashboard">
      <div class="main-container">
        <a class="navbar-brand" href="#">
          <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
          <p>USM.<span>Unigres</span></p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <div class="dropdown dropdown-acount-1">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Your name</a>
                    <div class="dropdown-menu dropdown-acount" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Logout</a>
                      </div>
                </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="dashboard">
      <div class="wrapper-dashboard-nav">
            <ul class="dashboard-top nav nav-pill" id="pills-tab1" role="tablist">
                <li class="nav-item" role="presentation">
                    <div class="nav-link " id="pills-home-tab1" data-bs-toggle="pill" data-bs-target="#pills-home1" type="button" role="tab" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <img src="{{ asset('unigres/images/data.svg') }}">
                        </div>
                        <span>Data Calon Mahasiswa</span>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill" data-bs-target="#pills-home2" type="button" role="tab" aria-controls="pills-home2" aria-selected="true">
                        <div class="wp-ic">
                            <span>Rp</span>
                        </div>
                        <span>Konfirmasi Pembayaran</span>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-link" id="pills-home-tab3" data-bs-toggle="pill" data-bs-target="#pills-home3" type="button" role="tab" aria-controls="pills-home3" aria-selected="true">
                        <div class="wp-ic">
                            <span>i</span>
                        </div>
                        <span>Informasi dan Pengumuman</span>
                    </div>
                </li>
            </ul>
        </div>
        
        <div class="tab-content" id="pills-tabContent1">
            <div class="tab-pane fade" id="pills-home1" role="tabpanel" aria-labelledby="pills-home-tab1">
                <div class="content">
                    <div class="container-fluid dashboard-user">
                        <h4>Form Pendaftaran</h4>
                        <p>Isi form berikut dengan menggunakan data yang valid (Benar).</p>
                        <ul class="nav nav-pills mb-5 mx-auto" id="pills-tab" role="tablist">
                            <li class="nav-item " role="presentation">
                                <span class="nav-link active" id="pills-home-tab"  data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Data Calon Mahasiswa</span>
                            </li>
                            <li class="nav-item nav-data-ortu" role="presentation">
                                <span class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Data Orang Tua/Wali</span>
                            </li>
                            <li class="nav-item nav-prodi" role="presentation">
                                <span class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Program Studi</span>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="container data-calon-mhs tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row dashboard-row">
                                        <div class="col-md-7 left dashboard-left">
                                            <div class="card">
                                                <div class="card-header">
                                                    Data Pribadi Calon Mahasiswa
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label for="no_ktp">Nama depan</label>
                                                            <input type="text" class="form-control" placeholder="Nama depan">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="no_ktp">Nama belakang</label>
                                                            <input type="text" class="form-control" placeholder="Nama belakang">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_ktp">Nomor identitas KTP</label>
                                                        <input type="text" name="no_ktp" required class="form-control" placeholder="Nomor identitas KTP">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label for="tempat_lahir">Tempat Lahir</label>
                                                            <input type="text" name="tempat_lahir" required class="form-control mr-2" placeholder="Tempat Lahir">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                                            <input type="date" name="tanggal_lahir" required class="form-control">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>Agama</label>
                                                                <select class="form-control" name="agama" required id="exampleFormControlSelect1">
                                                                    <option value="">- Pilih Agama -</option>
                                                                    <option>Islam</option>
                                                                    <option>Kristen</option>
                                                                    <option>Buddha</option>
                                                                    <option>Katolik</option>
                                                                    <option>Hindu</option>
                                                                </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="form-label lable-radio mb-3">Jenis Kelamin</label>
                                                            <div class="wrap-input">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                                    <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <label for="alamat" class="ml-2">Alamat</label>
                                                        <input type="text" name="alamat" required class="form-control" placeholder="Alamat Tinggal">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telepon" class="ml-2">No. Telepon</label>
                                                        <input type="tel" name="telepon" required class="form-control" placeholder="Contoh: 085807217211">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label for="asal_sma">Asal Sekolah</label>
                                                            <input type="text" name="asal_sma" required class="form-control mr-2" placeholder="Asal Sekolah">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="tahun_masuk">Tahun Masuk</label>
                                                            <input type="text" name="tahun_masuk" required class="form-control date-own" placeholder="YYYY">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-light btn-daftar">Submit</button>
                            
                                            <div class="catatan">
                                                <strong>Catatan :</strong>
                                                <p>Pastikan kembali data yang ada isi sudah benar sebelum menekan tombol submit</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 right dashboard-right">
                                            <div class="card">
                                                <div class="card-header">
                                                    Foto Kartu Peserta
                                                </div>
                                                <div class="card-body">
                                                    <img class="card-img-top" id="preview" src="{{ asset('unigres/images/profile.svg') }}" alt="Profile Picture">
                                                    <span class="btn btn-primary btn-file">
                                                        Browse <input type="file" name="foto" class="custom-file-input" id="foto">
                                                    </span>
                                                    <span class="text-left">
                                                        <label class="mt-4">Foto background biru, kemeja warna putih, bagi perempuan berhijab memakai kerudung hitam.</label>
                                                        <label class="mt-4">Format file: JPEG, JPG, PNG</label>
                                                        <label class="mt-0">Ukuran file maksimal: 1mb</label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
        
                            <div class="container data-orang-tua tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row">
                                    <div class="col-md-8 left">
                                        <form method="POST">
                                            <div class="card">
                                                <div class="card-header">
                                                    Data Orang Tua/Wali
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6 pr-2">
                                                                <label for="nama_ayah">Nama Ayah</label>
                                                                <input type="text" name="nama_ayah" required class="form-control mr-2" placeholder="Nama Ayah" value="">
                                                            </div>
                                                            <div class="col-md-6 pl-2">
                                                                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                                                <input type="text" name="pekerjaan_ayah" required class="form-control" placeholder="Pekerjaan Ayah" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6 pr-2">
                                                                <label for="nama_ibu">Nama Ibu</label>
                                                                <input type="text" name="nama_ibu" required class="form-control mr-2" placeholder="Nama Ibu" value="">
                                                            </div>
                                                            <div class="col-md-6 pl-2">
                                                                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                                                <input type="text" name="pekerjaan_ibu" required class="form-control" placeholder="Pekerjaan Ibu" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6 pr-2">
                                                                <label for="nama_wali">Nama Wali</label>
                                                                <input type="text" name="nama_wali" class="form-control mr-2" placeholder="Nama Wali" value="">
                                                            </div>
                                                            <div class="col-md-6 pl-2">
                                                                <label for="alamat_wali">Alamat Wali</label>
                                                                <input type="text" name="alamat_wali" class="form-control" placeholder="Alamat Wali" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telepon_wali" class="ml-2">No. Telepon</label>
                                                        <input type="tel" name="telepon_wali" class="form-control" placeholder="Contoh: 085807217211" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-light btn-daftar">Submit</button>
                            
                                            <div class="catatan">
                                                <strong>Catatan :</strong>
                                                <p>Pastikan kembali data yang ada isi sudah benar<br>sebelum menekan tombol submit</p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
        
                            <div class="container program-studi tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="row">
                                    <div class="col-md-8 left">
                                        <form method="POST"  enctype="multipart/form-data">
                                            <div class="card">
                                                <div class="card-header">
                                                    Data Program Studi
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="form-group">
                                                        <label>Program Studi 01</label>
                                                        <select class="form-control" name="agama" required id="exampleFormControlSelect1">
                                                            <option value="">- - Pilih Program Studi Pilhan Pertama - -</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="form-label lable-radio mb-3">Jenjang Pendidikan</label>
                                                        <div class="wrap-input">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                                <label class="form-check-label" for="inlineRadio1">D3</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                                <label class="form-check-label" for="inlineRadio2">D4</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                                                <label class="form-check-label" for="inlineRadio3">S1</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
                                                                <label class="form-check-label" for="inlineRadio4">S2</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Program Studi 02</label>
                                                        <select class="form-control" name="agama" required id="exampleFormControlSelect1">
                                                            <option value="">- - Pilih Program Studi Pilhan Pertama - -</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="form-label lable-radio mb-3">Jenjang Pendidikan</label>
                                                        <div class="wrap-input">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1a" value="option1a">
                                                                <label class="form-check-label" for="inlineRadio1a">D3</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2a" value="option2a">
                                                                <label class="form-check-label" for="inlineRadio2a">D4</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3a" value="option3a">
                                                                <label class="form-check-label" for="inlineRadio3a">S1</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4a" value="option4a">
                                                                <label class="form-check-label" for="inlineRadio4a">S2</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-light btn-daftar">Submit</button>
                            
                                            <div class="catatan">
                                                <strong>Catatan :</strong>
                                                <p>Pastikan kembali data yang ada isi sudah benar<br>sebelum menekan tombol submit</p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="pills-home2" role="tabpanel" aria-labelledby="pills-home-tab2">
                <div class="konfirmasi-pembayaran">
                    <div class="container">
                        <h4 class="title-konfirm1">Konfirmasi Pembayaran</h4>
                        <p  class="title-konfirm2">Isi form berikut dengan menggunakan data yang valid (Benar).</p>
                        <div class="row gx-5">
                            <div class="col-md-6 left">
                                <h5>Upload Bukti Pembayaran</h5>
                                <form action="#">
                                    <div class="mb-5">
                                        <label for="formFile" class="form-label">Browse File</label>
                                        <div class="input-group mb-3" style="overflow: hiden;">
                                            <div class="wp-input">
                                                <input type="file" class="form-control input-file" id="inputGroupFile02">
                                            </div>
                                            <label class="input-group-text" for="inputGroupFile02">Browse File</label>
                                          </div>
                                    </div>
                                    <button type="submit" class="btn btn-submit mb-5">Submit</button>
                                </form>
                                <p class="catatan">Catatan :</p>
                                <p class="catatan2">Pastikan kembali data yang ada isi sudah benar sebelum menekan tombol submit</p>
                            </div>
                            <div class="col-md-6 right">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Catatan</h5>
                                    </div>
                                    <div class="card-body">
                                        <ol>
                                            <li>Pembayaran dilakukan maksimal 3 hari setelah pendaftaran, apabila tidak melakukan konfirmasi pembayaran maka pendaftaran di batalkan.</li>
                                            <li>Pembayaran dikonfirmasi 1x 24 jam</li>
                                            <li>Pambayaran dengan format yang tidak sesuai harap mengkonfirmasi ke pihak keuangan.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper-info">
                            <img src="{{ asset('unigres/images/ic-i.svg') }}">
                            <p class="info1">Konfirmasi pembayaran <span>telah berhasil di kirim</span> dan menunggu persetujuan dari bagian keuangan. Apabila dalam 1x 24 jam belum di konfirmasi, silahkan hubungi bagian keuangan.</p>
                        </div>
                        <div class="wrapper-info2">
                            <img src="{{ asset('unigres/images/ic-i.svg') }}">
                            <p class="info1">Selamat konfirmasi pembayaran anda telah di setujui, silahkan download kartu peserta
                                dan cek jadwal ujian dan ruangan ujian anda.</p>
                        </div>
                        <div class="wrapper-button">
                            <button class="btn btn-download">Download - UMS0081024.pdf</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-home3" role="tabpanel" aria-labelledby="pills-home-tab3">
                <div class="info-pengumuman">
                    <div class="container">
                        <h4 class="title-info-pengumuman">Informasi dan Pengumuman</h4>
                        <p  class="title-info-pengumuman2">Informasi seputar seleksi ujian masuk universitas gresik</p>
                        <div class="wp-info-pengumuman">
                            <a class="link-item-ann" href="#">
                                <div class="wrappe-item-ann">
                                    <p class="item-ann-title-1">Ujian Seleksi Masuk tahun 2019</p>
                                    <p class="item-ann-title-2">Publised by : <span>Admin | 29 Oktober 2019</span></p>
                                    <span class="badge badge-item">NEW</span>
                                </div>
                            </a>
                            <a class="link-item-ann" href="#">
                                <div class="wrappe-item-ann">
                                    <p class="item-ann-title-1">Pendaftaran Mahasiswa Baru 2019</p>
                                    <p class="item-ann-title-2">Publised by : <span>Admin | 15 Oktober 2019</span></p>
                                </div>
                            </a>      
                            <a class="link-vm" href="#">
                                View More <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        
    </main>
    <footer class="dashboard">
        <ul class="wrapper-footer">
          <li>Copyright © 2019 Universitas Gresik</li>
          <li>Jl. Arif Rahman Hakim 2B, Gresik</li>
          <li>Telp.(031) 3981918, 3978628</li>
        </ul>
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>