<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <h3>Pesanan</h3>
      <form class="" action="{{@route('createRecipe')}}" method="post">
        {{ csrf_field() }}
          <table>
          <caption>Menu</caption>
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" id=""></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="price"></td>
            </tr>
            <tr>
                <td>description</td>
                <td><input type="text" name="desc"></td>
            </tr>   
          </table>
          <table>
            <caption>Ingredients Available</caption>
            <tr>
                    <th></th>
                    <th>Ingredient</th>
                    <th>Stock</th>
                    <th>Ingredient Needs</th>
                </tr>
            <?php foreach ($ingredients as $ingredient): ?>
             
                <tr>
                    <td><input type="checkbox" name="ingredientid[]" value="<?php echo $ingredient->ingredientid ?>"></td>
                    <td><?php echo $ingredient->name ?></td>
                    <td><?php echo $ingredient->stock ?></td>
                    <td><input type="text" name="qtyRecipeIngredients[]"></td>
                </tr>
            <?php endforeach; ?>
          </table>
          <input type="submit" name="" value="Create">   
      </form>
  </body>
</html>
