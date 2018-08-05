<?php
    // echo '<pre>';
    // var_dump($data);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="/main.css" />
    <script src="main.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="/resbroto.png" width="100" height="100" alt="">
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="chef_dashboard.html">Chef Dashboard - Edit Recipe
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <div class="input-group mr-2">
                    <input class="form-control" type="search" placeholder="Search" >
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
<!--             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button> -->
        </div>
    </nav>
    <form name="form-edit-recipes" method="post" action="{{@route('updateRecipe')}}">
                    {{csrf_field()}}
    <div class="container">
        <div class="row">

            <div class="col-4">
                <a href="{{@route('recipeDetails',['recipeid'=>$data[0]->recipeid])}}"><button type="button" class="btn btn-light btn-back">
                    <i class="fa fa-chevron-circle-left" style="font-size:24px"></i>
                    Back
                </button></a>
                
                <div class="form-group">
                        <label for="exampleInputEmail1">Name:</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name" name="recipe_name" placeholder="recipe name" value="<?php echo $data[0]->title; ?>" required>

                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Price</label>
                        <input type="text" class="form-control" id="price" aria-describedby="price" placeholder="" name="recipe_price" value="<?php echo $data[0]->price; ?>"  required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  name="recipe_description" required><?php echo $data[0]->description; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">CONFIRM CHANGES</button>
                
            </div>
            <div class="col-8 d-flex flex-column">
                <a href="recipe_add_new_ingredient.html" class="align-self-end"><button type="button" class="btn btn-light btn-add ">
                    ADD NEW INGREDIENT
                </button></a>
               
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">orders</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Stock</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php foreach ($dataIngredients as $listIngredients): ?>
                        <tr>
                            <td><?php echo $listIngredients->name ?></td>
                            <td>
                                <?php $found=FALSE;for ($i=0; $i < count($data) ; $i++) :?>
                                    <?php if($data[$i]->ingredientid == $listIngredients->ingredientid): ?>
                                        <?php $found=TRUE; ?>
                                            <input type="number" name="qtyRecipeIngredient[]" class="form-control" placeholder="0" value="<?php echo $data[$i]->ingredientid ?>" onchange="check(this.value, this.nextElementSibling)">
                                            <input type="checkbox" name="ingredientid[]" value="<?php echo $listIngredients->ingredientid ?>" class="ingredientid" checked >
                                            <?php break; ?>
                                        <?php endif ?>
                                <?php endfor;?>
                                <?php if ($found==FALSE): ?>
                                <input type="number" name="qtyRecipeIngredient[]" class="form-control" placeholder="0" onchange="check(this.value, this.nextElementSibling)">
                                <input type="checkbox" name="ingredientid[]" value="<?php echo $listIngredients->ingredientid ?>" class="ingredientid">
                                <?php endif; ?>
                            </td>
                            <td><?php echo  $listIngredients->stock; ?></td>
                        </tr>             
                    <?php endforeach; ?>

                    </tbody>
                </table>
                <input type="hidden" name="recipeid" value="<?php echo $data[0]->recipeid ?>">
                
            </div>
        </div>
    </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
    crossorigin="anonymous"></script>
    <script>
    
        
    function check(value, next) {

        
    /* var input_value = document.getElementById("checkbox-value").value; */
    console.log(next);
    console.log(value);
    
    if (value >= 1) {
        next.checked = true;
    }else{
        next.checked = false; 
    }
}
</script>
</html>