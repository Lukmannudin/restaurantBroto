<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Selamat Datang {{$nama}}</h1>
    @if($umur>0)
    <h1>Umur anda adalah {{$umur}}</h1>
    @else
    <h1>Anda Belum Lahir</h1>
    @endif
  </body>
</html>
