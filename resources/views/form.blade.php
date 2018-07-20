<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <form class="" action="{{@route('hallo')}}" method="post">
        {{ csrf_field() }}
          <p>Nama : <input type="text" name="nama" value=""></p>
          <p>Umur : <input type="text" name="umur" value=""></p>
          <p><input type="submit" value="Save"> </p>
      </form>
  </body>
</html>
