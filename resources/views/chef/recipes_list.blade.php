
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
                    <a class="nav-link" href="{{@route('chef')}}">Chef Dashboard
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-bell" style="font-size:24px"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
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
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>

        </div>
    </nav>

    <div class="container">
        <div class="submenu">
            <div class="">
                <a href="{{@route('chefToday')}}">Today's Orders</a>
            </div>
            <hr class="vertical-line">
            <div class="active">
                <a href="{{@route('recipeList')}}">Recipes List</a>
            </div>
        </div>


        <div class="row">
            <div class="col-6">
                <h6>Status</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">Available</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                    <label class="form-check-label" for="inlineCheckbox2">Unvailable</label>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{@route('CreateRecipes')}}"><button class="btn btn-info btn-add d-flex flex-row-reverse">CREATE RECIPE</button></a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" data-field="id" data-sortable="true">recipeid</th>
                    <th scope="col">Recipe Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Price</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $tempCek =""; $checkAvailbility = "Available";
                foreach ($recipes as $recipe): ?>
                <?php 
                    if ($recipe->qtyRecipeIngredients > $recipe->stock ) {
                        $checkAvailbility = "unavailable";
                    }

                    if ($tempCek != $recipe->recipeid) :
                        $tempCek = $recipe->recipeid;   
                 ?>
                <tr>
                    <th scope="row"><a href="{{@route('recipeDetails',['recipeid'=>$recipe->recipeid])}}"><?php echo $recipe->recipeid ?></a></th>
                    <td><?php echo $recipe->title ?></td>
                    <td><?php echo $checkAvailbility ?> </td>
                    <td><?php echo $recipe->price; ?></td>
                </tr>
                    <?php endif;?>
            <?php  endforeach; ?>  
            </tbody>
        </table>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
    crossorigin="anonymous"></script>

</html>