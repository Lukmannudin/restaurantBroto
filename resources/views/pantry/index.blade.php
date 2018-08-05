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
        <a class="navbar-brand" href="#"><img src="/resbroto.png" width="100" height="100" alt=""></a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Pantry Dashboard
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
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            </form>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
        </div>
    </nav>
    
    <div class="container">
         <table class="table">
                <thead>
                    <tr>
                        <th scope="col"  data-field="id" data-sortable="true">ingredientid</th>
                        <th scope="col">Name</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Unit of Measure</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <thead>
                <form action="{{@route('insertIngredient')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="ingredientid" value="<?php echo $lastid+1; ?>">
                        
                    
                    <tr><!-- ADD ITEM GOES HERE -->
                            <td scope="col" data-field="id" data-sortable="true"><h5><?php echo $lastid+1; ?></h5></td>
                            <td scope="col"><input type="text" class="form-control" name="name"> </td>
                            <td scope="col"><input type="number" class="form-control" name="stock"></td>
                            <td scope="col"><input type="text" class="form-control" name="unitofmeasure"></td>
                            <td scope="col"><input type="date" class="form-control" name="expiryDate"></td>
                            <td scope="col"><button type="submit" class="btn btn-light"><h6>ADD</h6></button></td>
                    </tr>
                    </form>
                </thead>
                <tbody>
                
                    <?php foreach ($data as $data) :?>
                    <form action="{{@route('updatePantry')}}" method="post">
                    {{ csrf_field() }}
                    <tr>
                        <th scope="row"><a href=""><?php echo $data->ingredientid ?></a></th>
                        <input type="hidden" name="ingredientid" value="<?php echo $data->ingredientid ?>">
                        <td><input type="text" class="form-control" value="<?php echo $data->name; ?>" name="name"></td>
                        <td><input type="number" name="stock" class="form-control" value="<?php echo $data->stock; ?>" min=0></td>
                        <td><input type="text" name="unitofmeasure" class="form-control" value="<?php echo $data->unit_of_measure; ?>"></td>
                        <td><input type="date" name="expiryDate" id="" value="<?php echo $data->expiryDate; ?>" class="form-control"></td>
                        <td class="btn-edit-delete">
                            <button type="submit"  class="btn btn-light" name="typeSubmit" value="edit"><i class="fa fa-save"></i></button>
                            <button type="submit"  class="btn btn-light"  name="typeSubmit" value="delete"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    </form>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">SAVE CHANGES</button>
                </div>
            </div>

    </div>

    
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
    crossorigin="anonymous"></script>
</html>