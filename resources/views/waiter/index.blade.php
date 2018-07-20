<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <h3>Pesanan</h3>
      <form class="" action="{{@route('waiterOrder')}}" method="post">
        {{ csrf_field() }}
          <table>
            <tr>
              <td>Nama Pemesan</td>
              <td><input type="text" name="nama"></td>
            </tr>
            <tr>
              <th></th>
              <th>Menu</th>
              <th>Description</th>
              <th>Qty</th>
            </tr>
              <?php foreach ($recipe as $menu): ?>
                  <tr>
                    <td><input type="checkbox" name="orderItem[]" value="<?php echo $menu->recipeid ?>"></td>
                    <td><?php echo $menu->title; ?></td>
                    <td><?php echo $menu->description; ?></td>
                    <td><input type="text" name="jml[]"></td>
                  </tr>
              <?php endforeach ?>
              <tr>
                <td>Meja yang tersedia</td>
              </tr>
                  <?php foreach ($table as $table): ?>
                   <?php if ($table->status != 0): ?>
                    <tr>                      
                      <td><input type="radio" name="orderTable" value="<?php echo $table->tableid;  ?>"></td>
                      <td><?php echo $table->identifier; ?></td>
                    </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                  
          </table>
          <input type="submit" name="" value="Pesan">   
      </form>
  </body>
</html>
