<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
        crossorigin="anonymous">
    <link rel="shortcut icon" href="{{asset('img/resbroto.png')}}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/main.css')}}" />
    
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
                    <a class="nav-link" href="chef_dashboard.html">Chef Dashboard - Add New Ingredient
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

            </ul>
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button> -->
        </div>
    </nav>

    <div class="container">
        <div class="row">


            <div class="col-8">
                <a href="{{@route('CreateRecipes')}}"><button type="button" class="btn btn-light btn-back">
                    <i class="fa fa-chevron-circle-left" style="font-size:24px"></i>
                    Back
                </button></a>
                <form name="form-edit-recipes" action="{{@route('createIng')}}" method="post">
                {{ csrf_field() }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Ingredient Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Units Of Measure</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td><input type="text" class="form-control" name="new_ingredient_name"  required></td>
                                <td>
                                    <input type="number" class="form-control" name="new_ingredient_recipe_qty" placeholder="0" required>
                                </td>
                                <td><input type="text" class="form-control" name="new_units_of_measure" required></td>
                            </tr>



                        </tbody>
                    </table>
                <button type="submit" class="btn btn-light btn-add align-self-end">
                    ADD NEW INGREDIENT
                </button>
                </form>
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