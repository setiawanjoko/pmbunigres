@extends('master-page')

@section('title', 'Kontak')

@section('content-title')
<h5 class="banner-caption">Kontak</h5>
<p class="banner-title">Informasi Kontak Kampus Kami.</p>
@endsection

@section('nav-bar')
<li class="nav-item">
  <a class="nav-link" aria-current="page" href="{{ route('homepage') }}">Beranda</a>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{ route('pengumuman') }}">Pengumuman</a>
</li>
<li class="nav-item">
  <a class="nav-link active" href="{{ route('kontak') }}">Kontak</a>
</li>
@endsection

@section('fill-content')
@endsection

@section('content')
<section class="announcement mt-5">
  <div class="second-container">
    <div class="row">
        <div class="col-lg-12">
            <p><a style="font-weight: bold;
              text-decoration: solid;" href="https://www.google.com/search?safe=strict&amp;q=universitas+gresik+alamat&amp;stick=H4sIAAAAAAAAAOPgE-LRT9c3zMg1zkrPTSnRks1OttLPyU9OLMnMz4MzrBJTUopSi4sXsUqW5mWWpRYVZ5YkFiukA8UysxUScxJzE0sALd8oi0sAAAA&amp;ludocid=1432422069902166228&amp;sa=X&amp;ved=2ahUKEwjb64XP86nhAhUo73MBHZUmAUwQ6BMwE3oECA8QAw">Alamat</a>&nbsp;:&nbsp;Jl. Arif Rahman Hakim Gresik No.2B, Kramatandap, Gapurosukolilo, Kec. Gresik, Kabupaten Gresik, Jawa Timur 61111</p>
            <p><a style="font-weight: bold;
              text-decoration: solid;" href="https://www.google.com/search?safe=strict&amp;q=universitas+gresik+provinsi&amp;stick=H4sIAAAAAAAAAOPgE-LRT9c3zMg1zkrPTSnRkstOttLPyU9OLMnMz4MzrAqK8ssy85JTF7FKl-ZllqUWFWeWJBYrpBelFmdmK0BkizMBLzaNCU4AAAA&amp;sa=X&amp;ved=2ahUKEwjb64XP86nhAhUo73MBHZUmAUwQ6BMoADAVegQIFBAC">Provinsi</a>&nbsp;:&nbsp;Jawa Timur</p>
            <p><a style="font-weight: bold;
              text-decoration: solid;" href="https://www.google.com/search?safe=strict&amp;q=universitas+gresik+telepon&amp;ludocid=1432422069902166228&amp;sa=X&amp;ved=2ahUKEwjb64XP86nhAhUo73MBHZUmAUwQ6BMwFnoECBMQAg">Telepon</a>&nbsp;:&nbsp;081 230 798 700</p>
            <figure><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.648924589624!2d112.65056281477428!3d-7.1665213948256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd8004662a078c7%3A0x13e0fc4884f2c8d4!2sUniversitas+Gresik!5e0!3m2!1sid!2sid!4v1521516613522" allowfullscreen="" width="100%" height="300"></iframe></figure>
        </div>
    </div>
</div>
</section>
@endsection
